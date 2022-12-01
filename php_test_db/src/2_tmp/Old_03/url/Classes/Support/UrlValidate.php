<?php

namespace PhpPro\url\Classes\Support;
namespace PhpPro\url\Interfaces;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use PhpPro\url\Interfaces\IValidateUrl;
use InvalidArgumentException;

//use Psr\Http\Client\ClientInterface;

/**
 * Class UrlValidate
 * Этот класс служит для двойной валидации URL
 * @package PhpPro\url\Classes
 */
class UrlValidate
{
    protected string $name;//Пока не имеет особого смысла
    protected string $url; //Введенный URL или пустая строка при неверном URL
    //protected object $logger;//Объкт записи в лог
    protected $error = null; //информация об ошибке
    public string $echoInf; //Сообщение о коррестности URL
    //protected ClientInterface $client;
    protected IValidateUrl $client;
    /**
     * UrlValidate constructor.
     * @param $url
     * @param $obj
     */
    public function __construct($url,$client)//ClientInterface $client
    {
        $this->name     = 'litos';//Пока смысла не имеет
        //$this->logger   = $obj;   //Инструмент записи в лог
        $this->url      = $url;   //Проверяемый Url
        $this->client   = $client;//Пробрасываемый объект для реальной валидации
    }


    /**
     * @param $url
     * @return bool
     *Метод ПРЕДВАРИТЕЛЬНУЮ ВАЛИДАЦИЮ (очень приблизительно) URL не проверяя реальность
      Вот такой http://lkjlklk корректный. В методе input пришлось / в конце добавлять
      Без слеша в конце нормальный URL не понимает. Надо внимательно следить, чтобы URL
      начинался с http:// или https://
     */
    public function firstValUrl($url):bool
    {

        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
        {
            $res=true;
            $this->echoInf = "URL   " . $url. "    коректний";
            //$this->logger->uniInfo('Введено попередньо валідний url:   '.$this->url);
            SingleLogger::getInstance()->geLogger()->info('Введено попередньо валідний url:   '.$this->url);
        }
        else {
            $res=false;
            $this->echoInf = "такого URL не існує";
            //$this->logger->uniError('Такого URL'.$this->url.' не існує');
            SingleLogger::getInstance()->geLogger()->error('Такого URL'.$this->url.' не існує');
        }

        return($res);

    }


    /**
     * @return bool
    Метод реализует повторную валидацию на РЕАЛЬНОЕ СУЩЕСТВОВАНИЕ */
    public function secondValUrl($url):bool
    {
        $allowCodes =[200,201,301,302];
        $response=$this->client->getResponseCode($url);
        if (!empty($response) && in_array($response,$allowCodes)) {
            $result=true;
            $this->echoInf='Даний URL реально існує   '.$this->url;
            //$this->logger->uniInfo('Даний URL :'. $this->url.' реально існує   ');
            SingleLogger::getInstance()->geLogger()->info('Даний URL :'. $this->url.' реально існує   ');
        }
        else{
            $result=false;
            $this->echoInf='але URL на даний момент не є дійсним     '. $this->url;
            //$this->logger->uniAlert('Даний URL :'. $this->url.' реально не існує   ');
            SingleLogger::getInstance()->geLogger()->alert('Даний URL :'. $this->url.' реально не існує   ');
        }

        return($result);
    }



}
