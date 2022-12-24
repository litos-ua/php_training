<?php

namespace Doctor\PhpPro\Core\WEB\Controllers;

use Doctor\PhpPro\ORM\DataMapper\Entity\User;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectRepository;

class UserController
{
    private EntityManager $em;
    /**
     * @var UserRepository
     */
    private ObjectRepository $ur;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->ur = $this->em->getRepository(User::class);
    }

    /**
     * @param int $id
     * @return string
     */
    public function getUser(int $id): string
    {
        $user = $this->ur->getUserAllDateById($id);                       //getUserAllDataById($id);
        return $user->getId() . ' - ' . $user->getLogin() . ' - ' . $user->getPhones()->current()->getPhone();
        //return 'User ID =   ' . (string) $id;
    }

}
