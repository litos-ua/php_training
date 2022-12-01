<?php

namespace Doctor\PhpPro\Core\DI;

use Closure;
use Doctor\PhpPro\Core\DI\Enums\RefResolver;
use Doctor\PhpPro\Core\DI\Interfaces\IContainerInterface;
use Doctor\PhpPro\Core\DI\ValueObjects\ServiceObject;
use Doctor\PhpPro\Core\Exceptions\ContainerException;
use Doctor\PhpPro\Core\Exceptions\ParameterNotFoundException;
use Doctor\PhpPro\Core\Exceptions\ServiceNotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class Container implements IContainerInterface
{
    /**
     * @var ServiceObject[]
     */
    protected array $services;

    /**
     * @var ?ContainerInterface
     */
    protected ?ContainerInterface $parameters = null;

    /**
     * @var array
     */
    protected array $serviceStore = [];

    /**
     * @var array
     */
    protected array $tagsStore;

    /**
     * Container constructor.
     * @param array $services
     * @param ContainerInterface $parameters
     */
    public function __construct(array $services, ContainerInterface $parameters)
    {
        $this->addServices($services);
        $this->parameters = $parameters;
        $this->checkTagsList();
    }

    protected function addServices(array $services): self
    {
        foreach ($services as $id => $data) {
            $this->services[$id] = ServiceObject::createFromArray($id, $data);
        }
        return $this;
    }

    protected function checkTagsList(): void
    {
        foreach ($this->services as $service) {
            if ($service->hasTags()) {
                $this->addTagsToList($service->getName(), $service->getTags());
            }
        }
    }

    /**
     * @param $id
     * @param array $tags
     */
    protected function addTagsToList($id, array $tags): void
    {
        foreach ($tags as $tag) {
            $this->tagsStore[$tag][] = $id;
        }
    }

    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        try {
            $result = $this->parameters->get($id);
        } catch (ParameterNotFoundException) {
            if (!$this->has($id)) {
                throw new ServiceNotFoundException('Service not found: ' . $id);
            }
            $result = $this->serviceStore[$id] ?? $this->createService($id);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    /**
     * @inheritDoc
     */
    public function getByTag(string $id): array
    {
        if (!isset($this->tagsStore[$id])) {
            throw new ServiceNotFoundException('Tag not found: ' . $id);
        }

        $services = [];
        foreach ($this->tagsStore[$id] as $serviceName) {
            $services[] = $this->get($serviceName);
        }

        return $services;
    }

    /**
     * @throws \ReflectionException
     * @throws ContainerExceptionInterface
     */
    protected function createService(string $id): object
    {
        $entry = $this->services[$id];

        if (!class_exists($entry->getClass())) {
            throw new ServiceNotFoundException($id . ' service class does not exist: ' . $entry->getClass());
        } elseif ($entry->isLock()) {
            throw new ContainerException($id . ' service contains a circular reference');
        }

        $entry->lockService();
        $arguments = $this->resolveArguments($entry->getArguments());

        $reflector = new \ReflectionClass($entry->getClass());
        $service = $reflector->newInstanceArgs($arguments);

        if ($entry->hasCalls()) {
            $this->initializeService($service, $entry);
        }
        $this->compilerPass($service, $entry, $entry->getCompiler());

        $this->serviceStore[$id] = $service;
        return $service;
    }

    /**
     * @param object $service
     * @param ServiceObject $entry
     * @param Closure $compiler
     * @throws ContainerExceptionInterface
     * @return void
     */
    protected function compilerPass(object $service, ServiceObject $entry, Closure $compiler): void
    {
        try {
            $compiler($this, $service, $entry);
        } catch (\Exception $e) {
            throw new ContainerException('Container compiler error: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string[] $argumentDefinitions
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function resolveArguments(array $argumentDefinitions): array
    {
        $arguments = [];
        foreach ($argumentDefinitions as $argumentId) {
            try {
                $method = $this->getMetodByIdType($argumentId);
                $argumentId = substr($argumentId, 1);
                $arguments[] = $this->{$method}($argumentId);
            } catch (Throwable $e) {
                $arguments[] = $argumentId;
            }
        }
        return $arguments;
    }

    protected function getMetodByIdType(string $id): string
    {
        return RefResolver::getTypeReference(substr($id, 0, 1))->value;
    }

    /**
     * @param object $service
     * @param ServiceObject $entry
     * @throws ContainerException
     */
    protected function initializeService(object $service, ServiceObject $entry)
    {
        foreach ($entry->getCalls() as $callDefinition) {
            if (!is_callable([$service, $callDefinition->getMethod()])) {
                throw new ContainerException($entry->getName() . ' service asks for call to uncallable method: ' . $callDefinition->getMethod());
            }
            $arguments = $this->resolveArguments($callDefinition->getArguments());
            call_user_func_array([$service, $callDefinition->getMethod()], $arguments);
        }
    }

}
