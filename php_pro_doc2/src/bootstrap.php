<?php

use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\DI\Container;

require_once __DIR__ . '/../vendor/autoload.php';


return new Container(
    array_merge(
        require_once __DIR__ . '/../parameters/services.php',
        require_once __DIR__ . '/../parameters/calculator_configs.php',
        require_once __DIR__ . '/../parameters/web_services.php',
        require_once __DIR__ . '/../parameters/commands.php'
    ),
    ConfigHandler::getInstance()->addConfigs(
        require_once __DIR__ . '/../parameters/config.php'
    )
);
