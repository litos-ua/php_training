<?php

use Doctor\PhpPro\Core\DI\Enums\ServiceConfigArrayKeys as S;
use Doctor\PhpPro\Core\WEB\Controllers\UrlController;
use Doctor\PhpPro\Core\WEB\Controllers\UserController;

return [

    "c.user" => [
        S::CLASSNAME => UserController::class,
        S::ARGUMENTS => [
            '@orm.doctrine.entityManager',
        ]
    ],
    "c.url" => [
        S::CLASSNAME => UrlController::class,
        S::ARGUMENTS => [
            $value //Приходит из строки URL через app
            ],
        ]
];