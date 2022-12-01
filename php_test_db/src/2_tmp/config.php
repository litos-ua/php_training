<?php

$dir=__DIR__ ."/config/config.json";
$dir1='..'.__DIR__;
$ini_array = file_get_contents($dir);
$ini_array = json_decode($ini_array,true);
print_r($ini_array);
$d1=$ini_array ['dataname'];
$d2=$ini_array ['logpath'][2];
echo $dir1. PHP_EOL;
echo $ini_array ['dataname'].PHP_EOL;
echo $ini_array ['servername'].PHP_EOL;
echo $ini_array ['username'].PHP_EOL;
echo $ini_array ['password'].PHP_EOL;
echo $ini_array ['Logger'][1].PHP_EOL;
echo $ini_array ['loglevel'][2].PHP_EOL;
echo $ini_array ['logpath'][2].PHP_EOL;

$jsonData=json_encode($ini_array);
try {
    file_put_contents(__DIR__ . '/../../test.json', $jsonData);
    $res=true;
}
catch (Exception $e) {
    $res=false;
    echo "*** Помилка запису у файл *** ". PHP_EOL;
}
echo PHP_EOL;

