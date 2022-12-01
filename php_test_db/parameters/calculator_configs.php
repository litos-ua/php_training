<?php

use Doctor\PhpPro\Calculator\Actions\Div;
use Doctor\PhpPro\Calculator\Actions\Expo;
use Doctor\PhpPro\Calculator\Actions\Multi;
use Doctor\PhpPro\Calculator\Actions\Sub;
use Doctor\PhpPro\Calculator\Actions\Sum;
use Doctor\PhpPro\Calculator\Calculator;
use Doctor\PhpPro\Calculator\SmartCalculator;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\DI\Enums\ServiceConfigArrayKeys as S;
use Doctor\PhpPro\Core\DI\ValueObjects\ServiceObject;

return [
    'calculator.app' => [
        S::CLASSNAME => Calculator::class,
        S::COMPILER => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var Calculator $object
             */
            foreach ($container->getByTag('calculator.action') as $item) {
                $object->actionRegistration($item);
            }
        },
    ],
    'calculator.smart.app' => [
        S::CLASSNAME => SmartCalculator::class,
        S::CALLS => [
            [
                S::METHOD => 'actionsRegistration',
                S::ARGUMENTS => [
                    '$calculator.action',
                ]
            ],
        ]
    ],

    'calculator.action.sum' => [
        S::CLASSNAME => Sum::class,
        S::TAGS => ['calculator.action']
    ],
    'calculator.action.sub' => [
        S::CLASSNAME => Sub::class,
        S::TAGS => ['calculator.action']
    ],
    'calculator.action.div' => [
        S::CLASSNAME => Div::class,
        S::TAGS => ['calculator.action']
    ],
    'calculator.action.multi' => [
        S::CLASSNAME => Multi::class,
        S::TAGS => ['calculator.action']
    ],
    'calculator.action.expo' => [
        S::CLASSNAME => Expo::class,
        S::TAGS => ['calculator.action']
    ],

];