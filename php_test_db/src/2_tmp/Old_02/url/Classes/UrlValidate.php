<?php
namespace PhpPro\url\Classes;


//Этот класс обрабатывает введенный с клавиатуры URL
//Надо внимательно следить, чтобы URL начинался с http:// или https://
class UrlValidate
{
    protected string $name;//Пока не имеет особого смысла
    protected string $url; //Введенный URL или пустая строка при неверном URL
    protected object $logger;//Объкт записи в лог
    protected        $error = null; //информация об ошибке
    public string    $echoInf; //Сообщение о коррестности URL


    public function __construct($obj)
    {
        $this->name='litos';//Пока смысла не имеет
        $this->logger=$obj;//Инструмент записи в лог
    }

    //Метод фильтрует (очень преблизительно) URL не проверяя реальность
    //Вот такой http://;lkjl;k;lk корректный. В методе input пришлось / в конце добавлять
    //Без слеша в конце нормальный URL не понимает
    public function valUrl($url):string
    {

        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
        {
            $this->echoInf = "URL   " . $url. "    коректний";
            $this->logger->info('Введено попередньо валідний url:   '.$this->url);
            //echo "URL   " . $url. "    коректний". PHP_EOL;
        }
        else {
            $this->url='';
            $this->echoInf = "такого URL не існує";
            $this->logger->error('Такого URL'.$this->url.' не існує');
            //echo "такого URL не існує" . PHP_EOL;
        }


        return($this->url);

    }

    //Метод вводит URL
    public function input()
    {
        $this->url=readline("Введіть url починая з http(s)://     ");
        $this->url=trim($this->url);
        if (substr($this->url, -1) != "/"){ //Функция без последнего слеша глючит
            $this->url=$this->url."/";
        }
        return ($this->url);
    }



}
