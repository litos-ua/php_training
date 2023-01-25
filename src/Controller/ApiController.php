<?php

namespace App\Controller;

use App\Entity\User;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class ApiController
{

    public function __construct(
        protected EntityManagerInterface $entityManager,
        //protected EntityRepository $entityRepository
    )
    {

    }
    #[Route('/api/user',methods: ['POST'])]
    public function apiAction(): Response
    {
        return  new Response('Test API is sucsessfull!!!');
    }

    //#[Route('/api/user',methods: ['GET'])]
    #[Route(
        '/api/user/{login}',
        requirements: ['login' => '([0-9,a-z,A-Z,_,-]'],
        methods: ['GET']
    )]
    public function apiFindUserByLogin(string $login): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($login);

        $refObj = new ReflectionClass($user);
        $pubProp = [];

        foreach ($refObj->getProperties() as $property) {
            $property->setAccessible(true);
            $pubProp[$property->getName()] = $property->getValue($user);
        }

        return  new JsonResponse($pubProp);
    }

}