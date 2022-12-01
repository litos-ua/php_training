<?php
namespace MyPhpPro\url;
use MyPhpPro\url\UrlValidate;
use MyPhpPro\url\CheckRealUrl;
use MyPhpPro\url\UrlDecoder;

//require_once __DIR__ . '/../autoload.php';
//require_once  'autoload.php';
require_once  'vendor/autoload.php';

$urlObj=new UrlValidate;
$url1=$urlObj->input(); //вводим url для проверки

/* производим валидацию (без проверки на реальное существование) url */
$resEncode=$urlObj->valUrl($url1); //В resEncode записываем результат предварительной валидации
echo $urlObj->echoInf .PHP_EOL; //Сообщение о предварительной валидации

/* В случае прохождения предварительной валидации производим проверку при по мощи CURL
на реальное существование и при удачном результате записываем файл*/
$ck=false; //маркер реальности URL
$repositPath = __DIR__ . '/'. 'url_info.txt';
if ($resEncode != ''){
    $urlR1=new CheckRealUrl($url1,$repositPath);//Пробрасываем на проверку URL и задаем хранилище
    $ck=$urlR1->checkUrl();//если URL реален, то в маркер true и запись в файл
    echo $urlR1->echoInf . PHP_EOL ;//Сообщение о реальности URL
}

//В случае реальности URL, декодируем информацию из файла.
// При некорректном url выдаем сообщение об ошибке
if($ck){

    $decod = new UrlDecoder( $repositPath);
    echo ('Результат декодування:   '.$decod->decode().PHP_EOL);
}



