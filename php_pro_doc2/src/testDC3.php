<?php

use Doctor\PhpPro\ORM\DataMapper\Entity\Phone;
use Doctor\PhpPro\ORM\DataMapper\Entity\User;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

require_once __DIR__ . '/../vendor/autoload.php';


$container = require_once __DIR__ . '/bootstrap.php';

/**
 * @var QueryBuilder $qb
 * * @var UserRepository $userRepository
 * @var EntityManager $em
 * @var Phone $phone
 * @var User $user
 */

try {
    $em = $container->get('orm.doctrine.entityManager');
    $userRepository = $em->getRepository(User::class);
    $id=15;
    $user2 = $userRepository->getUserAllDateById($id);
    //$ar_user2 = (array) $user2;
    //print_r($ar_user2);
    $user = $userRepository->findOneBy(['id'=>12]);

    echo $user->getLogin(). ' : ';
    foreach ($user->getPhones() as $phone){
        echo $phone->getPhone() . '  ' ;
    }
    echo PHP_EOL;
    $em->flush();

}catch (Exception $e) {
    echo $e->getCode() .': ' . $e->getMessage() . ' ('.$e->getLine().')' . PHP_EOL;
}
exit;
