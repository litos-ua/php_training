<?php
namespace PhpPro\url;
namespace PhpPro\url\Classes;

//require_once __DIR__ . '/../autoload.php';
//require_once  'autoload.php';
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};

require_once  'vendor/autoload.php';

//Формируем запись в лог
$pathe=__DIR__.'/log/my_error.log';
$pathi=__DIR__.'/log/my_info.log';
$patha=__DIR__.'/log/my_alert.log';
$log = new Logger('litos');
$log->pushHandler(new StreamHandler($pathe, Level::Error));
$log->pushHandler(new StreamHandler($patha, Level::Alert));
$log->pushHandler(new StreamHandler($pathi, Level::Info));



$urlObj=new UrlValidate($log);
$url1=(string) $urlObj->input(); //вводим url для проверки

/* производим валидацию (без проверки на реальное существование) url */
$resEncode=$urlObj->valUrl($url1); //В resEncode записываем результат предварительной валидации
echo $urlObj->echoInf .PHP_EOL; //Сообщение о предварительной валидации

/* В случае прохождения предварительной валидации производим проверку при по мощи CURL
на реальное существование и при удачном результате записываем файл*/
$ck=false; //маркер реальности URL
$repositPath = __DIR__ . '/'. 'url_info.txt';
if ($resEncode != ''){
    $urlR1=new CheckRealUrl($url1,$repositPath,$log);//Пробрасываем на проверку URL и задаем хранилище
    $ck=$urlR1->checkUrl();//если URL реален, то в маркер true и запись в файл
    echo $urlR1->echoInf . PHP_EOL ;//Сообщение о реальности URL
}

//В случае реальности URL, декодируем информацию из файла.
// При некорректном url выдаем сообщение об ошибке
if($ck){

    $decod = new UrlDecoder( $repositPath,$log);
    echo ('Результат декодування:   '.$decod->decode().PHP_EOL);
}

//$logger= new \Monolog\Logger('mylog.log');

