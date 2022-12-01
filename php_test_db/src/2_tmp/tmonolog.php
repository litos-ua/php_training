<?php
require_once 'vendor/autoload.php';
//require_once 'url\Interfaces\IUrlEncoder.php';
use Monolog\Handler\AbstractProcessingHandler;
use Psr\Log\LoggerInterface;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;




$path=__DIR__.'/url/log/test_error.log';
$pathi=__DIR__.'/url/log/test_info.log';

$log = new Logger('litos');
$log->pushHandler(new StreamHandler($path, Level::Error));
$log->pushHandler(new StreamHandler($pathi, Level::Info));




// add records to the log

$incyfr=(int) (readline("Введіть цифру 1 або 2     "));



if (($incyfr !=1) && ($incyfr !=2)) {
    $log->error('Error: Помилка вводу. Введіть 1 або 2');
} else {
    if ($incyfr == 1) {
        $log->info('Ви ввели цифру 1');
    } else {
        $log->info('Ви ввели цифру 2');
    }
}

echo PHP_EOL;