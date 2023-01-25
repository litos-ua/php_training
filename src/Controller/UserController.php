<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UserController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function __construct(
        protected EntityManagerInterface $entityManager,
        //protected EntityRepository $entityRepository
    )
    {

    }

    #[Route(
        '/user/{id}',
        requirements: ['id' => '\d+'],
        methods: ['GET']
    )]
   public function findUserById (mixed $id)
     {

         $user = $this->entityManager->getRepository(User::class)->find($id);

         $refObj = new ReflectionClass($user);
         $pubProp = [];

         foreach ($refObj->getProperties() as $property) {
             $property->setAccessible(true);
             $pubProp[$property->getName()] = $property->getValue($user);
         }

         return  new JsonResponse($pubProp);
     }
}