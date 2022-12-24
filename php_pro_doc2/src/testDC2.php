<?php
use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\ORM\DataMapper\DatabaseDM;
use Doctor\PhpPro\ORM\DataMapper\Entity\Phone;
use Doctor\PhpPro\ORM\DataMapper\Entity\User;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;
use Doctor\PhpPro\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

//use Doctor\PhpPro\ORM\DataMapper\Entity\;

require_once __DIR__ . '/../vendor/autoload.php';


$container = require_once __DIR__ . '/bootstrap.php';

/**
 * @var QueryBuilder $qb
 */
try {

    /**
     * СТРОИМ ЗАПРОСЫ ЧЕРЕЗ QUERY BUILDER --------------------------
     */

    $em = $container->get('orm.doctrine.entityManager');
    $qb = $em->getRepository(User::class)->createQueryBuilder('u');

    $qb->where('u.id = :id')
        ->setParameter('id',10)
        ->orderBy('u.login', 'ASC');
    $query = $qb->getQuery();
    $res=$query->getResult();


    $qb->where('u.id > :id')
        ->setParameter('id',12)
        ->orderBy('u.login', 'ASC');
    $query = $qb->getQuery();
    $res2=$query->getResult();

    $qb->where('u.id > :id')
        ->setParameter('id',12)
        ->orderBy('u.login', 'ASC');
    $query = $qb->getQuery();
    $res3=$query->getResult();


    //----------------------------------------------------------------


    /**
     * @var UserRepository $userRepository
     * @var EntityManager $em
     * @var Phone $phone
     * @var User $user
     */
    $userRepository = $em->getRepository(User::class);

    /*Работает
    $user = $userRepository->findOneBy(['id'=>7]);
    $userS = $userRepository->findBy(['status'=>2]);
    */
    $user = $userRepository->findOneBy(['id'=>12]);
    echo $user->getLogin(). ' : ';
    foreach ($user->getPhones() as $phone){
        echo $phone->getPhone() . '  ' ;
    }
    echo PHP_EOL;
    //$phones = $em->getRepository(Phone::class)->findAll();
    //$phones = $em->getRepository(Phone::class)->findOneBy(['user' => 12]);
    $em->flush();




    $banned = $userRepository->getBanList();
    $em->flush();

    $query2 = $em->createQuery('SELECT u FROM \Doctor\PhpPro\ORM\DataMapper\Entity\User u WHERE u.status = 1');
    $users2 = $query2->getResult();
    //var_dump($users2);


} catch (Exception $e) {
    echo $e->getCode() .': ' . $e->getMessage() . ' ('.$e->getLine().')' . PHP_EOL;
}
exit;
