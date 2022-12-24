<?php

use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\DI\Enums\ServiceConfigArrayKeys as S;
use Doctor\PhpPro\ORM\ActiveRecord\DatabaseAR;
use Doctor\PhpPro\ORM\DataMapper\DatabaseDM;
use Doctor\PhpPro\Shortener\DBRepository;
use Doctor\PhpPro\Core\DI\ValueObjects\ServiceObject;
use Doctor\PhpPro\Shortener\FileRepository;
use Doctor\PhpPro\Shortener\Helpers\UrlValidator;
use Doctor\PhpPro\Shortener\UrlConverter;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

return [

    "orm.eloquent" => [
        S::CLASSNAME => DatabaseAR::class,
        S::ARGUMENTS => [
            '%db.mysql.dbname',
            '%db.mysql.user',
            '%db.mysql.pass',
            '%db.mysql.host',
        ]
    ],
    "orm.doctrine.creator" => [
        S::CLASSNAME => DatabaseDM::class,
        S::ARGUMENTS => [
            '%db.mysql.dbname',
            '%db.mysql.user',
            '%db.mysql.pass',
            '%db.mysql.host',
            true,
//            'pdo_mysql',
//            [
//                'Calculator/Entity',
//                'Shotener/Entity',
//            ]
        ]
    ],
    "orm.doctrine.entityManager" => [
        S::CLASSNAME => EntityManager::class,
        S::COMPOSITION => ["@orm.doctrine.creator" => 'getEM'],
        S::CALLS => [
            [
                S::METHOD => 'clear',
                S::ARGUMENTS => []
            ]
        ]
    ],
    "shortener.converter" => [
        S::CLASSNAME => UrlConverter::class,
        S::ARGUMENTS => [
            '@shortener.codeDBRepository',
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
    "shortener.codeDBRepository" => [
        S::CLASSNAME => DBRepository::class,
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

//    "monolog.logger" => [
//        S::CLASSNAME => Logger::class,
//        S::ARGUMENTS => [
//            '%monolog.channel',
//        ],
//        S::COMPILER => function (Container $container, object $object, ServiceObject $refs) {
//            /**
//             * @var Logger $object
//             */
//            foreach ($container->getByTag('monolog.stream') as $item) {
//                $object->pushHandler($item);
//            }
//        },
//
//    ],
//    "monolog.streamHandler.info" => [
//        S::CLASSNAME => StreamHandler::class,
//        S::ARGUMENTS => [
//            '%monolog.level.info',
//            Level::Info
//        ],
//        S::TAGS => ['monolog.stream']
//    ],
//    "monolog.streamHandler.error" => [
//        S::CLASSNAME => StreamHandler::class,
//        S::ARGUMENTS => [
//            '%monolog.level.error',
//            Level::Error
//        ],
//        S::TAGS => ['monolog.stream']
//    ],
//    "monolog.streamHandler.debug" => [
//        S::CLASSNAME => StreamHandler::class,
//        S::ARGUMENTS => [
//            '%monolog.level.debug',
//            Level::Debug
//        ],
//        S::TAGS => ['monolog.stream']
//    ],

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
            //Level::Error
        ],
        S::TAGS => ['monolog.stream']
    ],

    "monolog.pushHandler.streamhandler.error" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.info',
            //Level::Info
        ],
        S::TAGS => ['monolog.stream']
    ],



];