<?php

use Doctor\PhpPro\Calculator\Calculator;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\DI\Enums\ServiceConfigArrayKeys as S;
use Doctor\PhpPro\Core\DI\ValueObjects\ServiceObject;
use Doctor\PhpPro\Datawork\DbRequestHandler;
use Doctor\PhpPro\Shortener\FileRepository;
use Doctor\PhpPro\Shortener\Helpers\UrlValidator;
use Doctor\PhpPro\Shortener\UrlConverter;
use GuzzleHttp\Client;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};

return [

    "shortener.converter" => [
        S::CLASSNAME => UrlConverter::class,
        S::ARGUMENTS => [
            '@shortener.codeRepository',
            '@shortener.urlValidator',
            '%urlConverter.codeLength',
        ]
    ],
    "shortener.codeRepository" => [
        S::CLASSNAME => FileRepository::class,
        S::ARGUMENTS => [
            '%dbFile',
        ]
    ],
    "shortener.urlValidator" => [
        S::CLASSNAME => UrlValidator::class,
        S::ARGUMENTS => [
            '@guzzle.client',
        ]
    ],
    "guzzle.client" => [
        S::CLASSNAME => Client::class,
    ],

    "monolog.logger" => [
        S::CLASSNAME => Logger::class,
        S::ARGUMENTS => [
            '%monolog.channel',
    ],

        S::COMPILER => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var Logger $object
             */
            foreach ($container->getByTag('monolog.stream') as $item) {
                $object->pushHandler($item);
            }
        },

    ],

    "monolog.pushHandler.streamhandler.info" => [
    S::CLASSNAME => StreamHandler::class,
    S::ARGUMENTS => [
        '%monolog.level.error',
        Level::Error
         ],
    S::TAGS => ['monolog.stream']
    ],

     "monolog.pushHandler.streamhandler.error" => [
     S::CLASSNAME => StreamHandler::class,
     S::ARGUMENTS => [
         '%monolog.level.info',
         Level::Info
         ],
     S::TAGS => ['monolog.stream']
     ],


    "pdo.mysql.client" => [
        S::CLASSNAME => PDO::class,
    ],


    "data.request" => [
        S::CLASSNAME => DbRequestHandler::class,
        S::ARGUMENTS => [
            //'@pdo.mysql.client',
            '%connectdb.servername',
            '%connectdb.username',
            '%connectdb.password',
            '%connectdb.dbname'
        ]
    ],

];