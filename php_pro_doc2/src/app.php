<?php

use Doctor\PhpPro\Core\CLI\CLIWriter;
use Doctor\PhpPro\Core\CLI\CommandHandler;
use Doctor\PhpPro\Core\CLI\Commands\HelpCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlDecodeCommand;
use Doctor\PhpPro\Core\CLI\Commands\UrlEncodeCommand;
use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Core\Helpers\SingletonLogger;
use Doctor\PhpPro\Shortener\{FileRepository,
    Helpers\UrlValidator,
    UrlConverter
};
use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use UfoCms\ColoredCli\CliColor;

require_once 'vendor/autoload.php';

$configs = require_once __DIR__ . '/../parameters/config.php';
$configHandler = ConfigHandler::getInstance()->addConfigs($configs);

$commandHandler = new CommandHandler(new HelpCommand());
$monolog = new Logger($configHandler->get('monolog.channel'));
$monolog->pushHandler(new StreamHandler($configHandler->get('monolog.level.error'), Level::Error))
    ->pushHandler(new StreamHandler($configHandler->get('monolog.level.info'), Level::Info));

$singletonLogger = SingletonLogger::getInstance($monolog);

$fileRepository = new FileRepository($configHandler->get('dbFile'));
$urlValidator = new UrlValidator(new Client());
$converter = new UrlConverter(
    $fileRepository,
    $urlValidator,
    $configHandler->get('urlConverter.codeLength')
);

$commandHandler->addCommand(new UrlEncodeCommand($converter));
$commandHandler->addCommand(new UrlDecodeCommand($converter));

$commandHandler->handle($argv, function ($params, \Throwable $e) {
    SingletonLogger::error($e->getMessage());
    CLIWriter::getInstance()->setColor(CliColor::RED)
        ->writeLn($e->getMessage());

    CLIWriter::getInstance()->write($e->getFile() . ': ')
        ->writeLn($e->getLine());
});

exit;


