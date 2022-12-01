<?php
$dataname    = ["dataname" => "/../data/url_info.txt"];
$servername  = ["servername" => "host.docker.internal"];
$username    = ["username"   => "username"];
$password    = ["password" => "sysdba"];
$logger      = ["logger" => 'main', "litos"];
$loglevel    = ["logerlevel" => "error", "alert", "info"] ;
$logpath     = ["logpath" => array("/log/my_error.log",
                               "/log/my_alert.log",
                               "/log/my_info.log")];

echo "Количество входящих параметров:  " . $argc . PHP_EOL;
print_r($argv);
echo PHP_EOL;

//echo gettype($dataname) . PHP_EOL;
//echo gettype($logpath) . PHP_EOL;
//echo $dataname ["dataname"] . PHP_EOL;
//echo $logpath ["logpath"][1].PHP_EOL;
//$new_logpath = $logpath;
//echo $new_logpath ["logpath"][2].PHP_EOL;
//echo PHP_EOL;




