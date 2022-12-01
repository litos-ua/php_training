<?php
declare(strict_types = 1);
namespace PhpPro\url;
namespace PhpPro\url\Classes;
namespace PhpPro\url\Classes\Support;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};
require_once  'vendor/autoload.php';

$inputObj   = new UrlInput(); //Создаем объект для ввода в консоли
$url1=$inputObj->inputUrl(); //вводим в консоли url для проверки


$simplelogger= SingleLogger::getInstance(new Logger('litos'));
$simplelogger->pushHandler(new StreamHandler(__DIR__ .'../../log/my_error.log', Level::Error));
$simplelogger->pushHandler(new StreamHandler(__DIR__ . '../../log/my_info.log', Level::Alert));
$simplelogger->pushHandler(new StreamHandler(__DIR__ . '../../log/my_alert.log', Level::Info));


/**
 * Для повторной валидации можно использовать либо CUrl либо Guzzle
 */
//----------------------------CUrl----------------------------------------
/*$MyValCUrl  = new MyCUrl();
$urlObj     = new UrlValidate($url1,$MyLogger,$MyValCUrl); */

//--------------------------Guzzle----------------------------------------
$MyGuzzle   = new MyGuzzle(new \GuzzleHttp\Client());
//$urlObj     = new UrlValidate($url1,$MyLogger,$MyGuzzle);
$urlObj     = new UrlValidate($url1,$MyGuzzle);

/**
 * производим валидацию (без проверки на реальное существование) url
 */
$resFirstVal=$urlObj->firstValUrl($url1); //В resFirstVal записываем результат предварительной валидации
echo $urlObj->echoInf .PHP_EOL; //Выводим результат предварительной валидации

/**
 * В случае прохождения предварительной валидации производим проверку при по мощи CURL
 * на реальное существование и при удачном результате записываем файл
 */
$realValidRes=false; //маркер реальности URL
$repositPath = __DIR__ . '/'. 'url_info.txt'; //Путь к файлу-хранилищу

if ($resFirstVal ){
    $urlR1=new UrlEncode($url1,$repositPath);//Пробрасываем на проверку URL и задаем хранилище
    $repoObj  = new DataRepo($repositPath);
    $realValidRes=$urlObj->secondValUrl($url1);//если URL реален, то в маркер true и запись в файл
    echo $urlObj->echoInf . PHP_EOL ;//Сообщение о реальности URL
}

/** В случае реальности URL, кодируем (декодируем) информацию в (из) файл(а).
 *  При некорректном url выдаем сообщение об ошибке
 */
if($realValidRes){
    $codingContent=$urlR1->encode($url1); //Кодируем Url
    $repoObj->saveStringRepo($codingContent);//запись в файл закодированного Url

    $decod = new UrlDecoder( $repositPath);//Создаем объект для раскодирования информации
    echo ('Результат декодування:   '.$decod->decode($repoObj->readCodeRepo()).PHP_EOL); //раскодируем и выводим информацию
}





