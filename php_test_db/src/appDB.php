<?php
use Monolog\Level;
use Monolog\Logger;
use PhpPro\WrPdo\PDOWR;
use UfoCms\ColoredCli\CliColor;


require_once 'vendor/autoload.php';
require_once 'WrPDO/PDOWR.php';
require_once __DIR__ . '/../parameters/config_db.php';
require_once 'User.php';

try{
    $items = PDOWR::getAll("SELECT * FROM `registr` WHERE `status` = 1");
    print_r($items);
} catch (PDOException $e){
    PDOWR::getError();
}
print_r(PDOWR::getStructure('registr'));
$res = PDOWR::getSelect('SELECT * FROM `currier`');
print_r($res);

$res=PDOWR::getParamSelect("SELECT * FROM `registr` WHERE `status` = ?", array(0));
print_r($res);
PDOWR::destroy();