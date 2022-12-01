<?php

use Doctor\PhpPro\Core\CLI\CommandHandler;
use Doctor\PhpPro\Core\CLI\Commands\CalculatorCommand;
use Doctor\PhpPro\Core\CLI\Commands\HelpCommand;
//use Doctor\PhpPro\Core\CLI\Commands\MyNameCommand;
use Doctor\PhpPro\Core\CLI\Commands\TestCommand;
use Doctor\PhpPro\Core\CLI\Commands\MyNameCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlDecodeCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlEncodeCommand;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\DI\Enums\ServiceConfigArrayKeys as S;
use Doctor\PhpPro\Core\DI\ValueObjects\ServiceObject;
use PhpPro\Core\CLI\Commands\DbRequestCommand;

return [
    // ----------- COMMANDS -----------

    "cli.commandHandler" => [
        S::CLASSNAME => CommandHandler::class,
        S::ARGUMENTS => [
            '@cli.command.help',
        ],
        S::COMPILER => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var CommandHandler $object
             */
            foreach ($container->getByTag('cli.command') as $item) {
                $object->addCommand($item);
            }
        },
    ],

    "cli.command.help" => [
        S::CLASSNAME => HelpCommand::class,
        S::ARGUMENTS => [
            '$allowed.command',
        ],

        S::TAGS => ['cli.command']
    ],

    "cli.command.test" => [
        S::CLASSNAME => TestCommand::class,
        S::TAGS => ['cli.command', 'allowed.command']
    ],

    "cli.command.my_name" => [
        S::CLASSNAME => MyNameCommand::class,
        S::TAGS => ['cli.command', 'allowed.command']
    ],

    "cli.command.db_select" => [
        S::CLASSNAME => DbRequestCommand::class,
        S::ARGUMENTS => [
            '@data.request'
        ],
        S::TAGS => ['cli.command', 'allowed.command','db.command']
    ],


    "cli.command.urlEncode" => [
        S::CLASSNAME => UrlEncodeCommand::class,
        S::ARGUMENTS => [
            '@shortener.converter'
        ],
        S::TAGS => ['cli.command', 'allowed.command']
    ],

    "cli.command.urlDecode" => [
        S::CLASSNAME => UrlDecodeCommand::class,
        S::ARGUMENTS => [
            '@shortener.converter'
        ],
        S::TAGS => ['cli.command', 'allowed.command']
    ],

    "cli.command.calculator" => [
        S::CLASSNAME => CalculatorCommand::class,
        S::ARGUMENTS => [
            '@calculator.app'
        ],
        S::TAGS => ['cli.command', 'allowed.command']
    ],
];