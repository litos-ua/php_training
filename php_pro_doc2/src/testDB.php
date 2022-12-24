<?php

use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\ORM\ActiveRecord\DatabaseAR;
use Doctor\PhpPro\ORM\ActiveRecord\Models\Phone;
use Doctor\PhpPro\ORM\ActiveRecord\Models\User;
use Doctor\PhpPro\ORM\DataMapper\DatabaseDM;
use Doctor\PhpPro\Shortener\ValueObjects\UrlCodePair;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';


$container = new Container(
    array_merge(
        require_once __DIR__ . '/../parameters/services.php',
        require_once __DIR__ . '/../parameters/calculator_configs.php',
        require_once __DIR__ . '/../parameters/commands.php'
    ),
    ConfigHandler::getInstance()->addConfigs(
        require_once __DIR__ . '/../parameters/config.php'
    )
);



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
exit;