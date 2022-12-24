<?php

use Carbon\Carbon;

require_once 'vendor/autoload.php';

$int = new DateInterval('P1Y');
$date = new DateTime();
$date->add($int);



$carbon = (new Carbon())->addYear();



$logger = new Monolog\Logger('general');
$logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__  . '/../demo.log', \Monolog\Level::Info));

$logger->error("ERROR: Some error");

exit;


