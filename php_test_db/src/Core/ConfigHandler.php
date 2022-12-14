<?php

namespace Doctor\PhpPro\Core;

use Doctor\PhpPro\Core\Exceptions\ParameterNotFoundException;
use Doctor\PhpPro\Core\Interfaces\IConfigHandler;
use Doctor\PhpPro\Core\Interfaces\ISingleton;
use Doctor\PhpPro\Core\Traits\SingletonTrait;

/**
 * @property string $environment
 */
class ConfigHandler implements IConfigHandler, ISingleton
{
    use SingletonTrait;

    /**
     * @var array Parameters from file
     */
    protected array $parameters = [];

    /**
     * @description Parameter array loading method
     * @param array $configs
     * @return $this
     * Добавляет конфиги
     */
    public function addConfigs(array $configs): self
    {
        $this->parameters = array_merge($this->parameters, $configs);
        return $this;
    }

    /**
     * @inheritDoc
     * Проверяем есть ли конфиг с конкретным id
     */
    public function has(string $id): bool
    {
        try {
            $result = true;
            $this->getRealPath($id);
        } catch (ParameterNotFoundException $e) {
            $result = false;
        }
        return $result;
    }

    /**
     * @inheritDoc
     * Получаем конфиг с конкретным id
     */
    public function get(string $id): mixed
    {
        return $this->getRealPath($id);
    }

    public function __get($name)
    {
        return $this->get(str_replace('_', '.', $name));
    }
    //По параметрам через "." получаем параметры из конфига
    protected function getRealPath(string $id): mixed
    {
        $tokens = explode('.', $id);
        $context = $this->parameters;

        while (null !== ($token = array_shift($tokens))) {
            if (!isset($context[$token])) {
                throw new ParameterNotFoundException('Parameter not found: ' . $id);
            }

            $context = $context[$token];
        }
        return $context;
    }
}