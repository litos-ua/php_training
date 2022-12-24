<?php
return [
    'shortener' => [
        'b' => [
            'c' => 123
        ]
    ],
    'db' => [
        'mysql' => [
            'type' => 'mysql',
            'host' => 'db_mysql',
            'port' => '13306',
            'dbname' => 'php_pro2',
            'user' => 'doctor',
            'pass' => 'pass4doctor',
        ],
    ],
    'environment' => 'prod',
    'dbFile' => __DIR__ . '/../storage/db.json',
    'monolog' => [
        'channel' => 'general',
        'level' => [
            'error' => __DIR__ . '/../logs/error.log',
            'info' => __DIR__ . '/../logs/info.log',
            'debug' => __DIR__ . '/../logs/debug.log',
        ],
    ],
    'urlConverter' => [
        'codeLength' => 8,
        'url' => 'https://kolodziejska.pl',
    ],
];