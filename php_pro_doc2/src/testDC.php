<?php
use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\DI\Container;
//use Doctor\PhpPro\ORM\ActiveRecord\DatabaseAR;
//use Doctor\PhpPro\ORM\ActiveRecord\Models\Phone;
//use Doctor\PhpPro\ORM\ActiveRecord\Models\User;
use Doctor\PhpPro\ORM\DataMapper\DatabaseDM;
use Doctor\PhpPro\ORM\DataMapper\Entity\Phone;
use Doctor\PhpPro\ORM\DataMapper\Entity\User;
use Doctor\PhpPro\ORM\DataMapper\Repositories\UserRepository;
use Doctor\PhpPro\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManager;
//use Doctor\PhpPro\ORM\DataMapper\Entity\;

require_once __DIR__ . '/../vendor/autoload.php';


$container = require_once __DIR__ . '/bootstrap.php';

/*
try {
    $container->get('orm.eloquent');
    $allUser = User::getActiveUsers();
    foreach ($allUser as $user) {
        $user->status = 1;
        foreach ($user->phones as $phone) {
            echo $phone->phone . ', ';
        }
//        $user->save();
        echo PHP_EOL;
        echo $user->id . " - " . $user->login . " - " . $user->status . " - ";
        echo PHP_EOL;
    }
//    $newPhone = Phone::createPhone($user, '+3800001');
} catch (Exception $e) {
    echo $e->getCode() .': ' . $e->getMessage() . ' ('.$e->getLine().')' . PHP_EOL;
}
*/

try {
    $em = $container->get('orm.doctrine.entityManager');
    //$Samantha = new \Doctor\PhpPro\ORM\DataMapper\Entity\User('SamFord', 'iyiy888YtR)', 2);
    //$em->persist($Samantha);
    /**
     * @var UserRepository $userRepository
     * @var EntityManager $em
     * @var Phone $phone
     * @var User $user
     */
    $userRepository  = $em->getRepository(User::class);
    $phoneRepository = $em->getRepository(Phone::class);
    $userOne = $userRepository->findOneBy(['id'=>7]);
    $userSGroup = $userRepository->findBy(['status'=>2]);
    $em->flush();

    $id=15;
    //$user2 = $userRepository->getUserAllDateById2($id);
    $qb = $em->getRepository(User::class)->createQueryBuilder('u');

    $qb->leftJoin(Phone::class,'p', 'WITH', 'p.id = :id')
       ->setParameter('id',$id)
       ->setMaxResults(3);
    $res = $qb->getQuery()->getResult();

//    $qb ->leftJoin(Phone::class,'p','WITH', 'p.user = u.id')
//                     ->where('u.id = id:')
//                     ->setParameter('id',$id)
//                     ->setMaxResults(1);
//          $res = $qb->getQuery()->getResult();

    $banned = $userRepository->getBanList();
    $findName = $userRepository->getByLogin('NatashaNSB');
    $user2 = $userRepository->getUserAllDateById(25);
    $em->flush();

    //Вводили телефон. Работает. Потом переделал на ввод пользователя с телефоном. Тоже работает.
    /*
    $newuser = new User('Stephan','HG786utuytu',User::STATUS_ACTIVE);
    $phone = new Phone($newuser,380967558811);
    $em->persist($phone);
    $em->persist($newuser);
    $em->flush();
    */


    $query2 = $em->createQuery('SELECT u FROM \Doctor\PhpPro\ORM\DataMapper\Entity\User u WHERE u.status = 1');
    $users2 = $query2->getResult();
    $query3 = $em->createQuery('SELECT u FROM \Doctor\PhpPro\ORM\DataMapper\Entity\User u WHERE u.age > 35');
    $users3 = $query3->getResult();
    $query4 = $em->createQuery('SELECT u,p FROM \Doctor\PhpPro\ORM\DataMapper\Entity\User u INNER JOIN 
                                    \Doctor\PhpPro\ORM\DataMapper\Entity\Phone p');
    $users3 = $query4->getResult();
    //var_dump($users2);



    $user = $userRepository->findOneBy(['id'=>12]);
    echo $user->getLogin(). ' : ';
    foreach ($user->getPhones() as $phone){
        echo $phone->getPhone() . '  ' ;
    }
    echo PHP_EOL;
    //$phones = $em->getRepository(Phone::class)->findAll();
    //$phones = $em->getRepository(Phone::class)->findOneBy(['user' => 12]);
    $em->flush();



} catch (Exception $e) {
    echo $e->getCode() .': ' . $e->getMessage() . ' ('.$e->getLine().')' . PHP_EOL;
}


exit;






