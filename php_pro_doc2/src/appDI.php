<?php

use Doctor\PhpPro\Core\CLI\CLIWriter;
use Doctor\PhpPro\Core\CLI\CommandHandler;
use Doctor\PhpPro\Core\CLI\Commands\HelpCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlDecodeCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlEncodeCommand;
use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\Helpers\SingletonLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;

require_once 'vendor/autoload.php';

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
$container->get('orm.eloquent');

$monolog = $container->get('monolog.logger');
$singletonLogger = SingletonLogger::getInstance($monolog);

/**
 * @var CommandHandler$commandHandler
 */
$commandHandler = $container->get('cli.commandHandler');
$commandHandler->handle($argv, function ($params, \Throwable $e) {
    SingletonLogger::error($e->getMessage());
    CLIWriter::getInstance()->setColor(CliColor::RED)
        ->writeLn($e->getMessage());

    CLIWriter::getInstance()->write($e->getFile() . ': ')
        ->writeLn($e->getLine());
});


exit;
