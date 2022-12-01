<?php
namespace MyPhpPro\url;

use Exception;
use MyPhpPro\url\Interfaces\IUrlEncoder;

//Проверяем реальнось URL
class CheckRealUrl implements IUrlEncoder
{
    protected string $url; //URL для проверки
    public string $echoInf; //Сообщение о реальности URL
    protected string $repositPath; //Наименование хранилища

    public function __construct($url,$path)
    {
      $this->url=$url;//Получаем из вне URL
        $this->repositPath=$path;
    }

    public function checkUrl():bool
    {
        $allowCodes =[200,201,301,302];
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$this->url);
        curl_setopt($ch,CURLOPT_NOBODY,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_exec($ch);
        $response = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        if (!empty($response) && in_array($response,$allowCodes)) {
            $result=true;
            $this->encode($this->url);
            $this->echoInf='Даний URL реально існує   '.$this->url;
            //echo 'Даний URL реально існує   '.$url . PHP_EOL;
        }
        else{
            $result=false;
            $this->echoInf='але URL на даний момент не є дійсним     '. $this->url;
            //echo 'але URL на даний момент не є дійсним     '. $url . PHP_EOL;
        }
        return($result);
    }


    //Метод записывает строку в файл
    public function encode(string $furl):string
    {
        date_default_timezone_set('Europe/Kyiv');//Устанавливаем часовой пояс
        $date = date('m/d/Y h:i:s a', time()).PHP_EOL;//Получаем текущее время
        $somecontent = convert_uuencode($furl);//Примитивное кодирование строки URL

        try {
            $fp = fopen ($this->repositPath, "a+");
            fwrite($fp,$date);
            fwrite($fp,$somecontent);
            fclose($fp);}
        catch (Exception $e) {
            echo "*** Помилка запису у файл *** ". PHP_EOL;
        }
        return($somecontent);
    }
};
