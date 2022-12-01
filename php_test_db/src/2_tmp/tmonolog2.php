<?php
require_once 'vendor/autoload.php';
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger=new Logger('Litos');
$pathi=__DIR__.'/url/log/test_info.log';
$logger->pushHandler(new StreamHandler($pathi, Level::Info));
$logger->info('Loggin information');