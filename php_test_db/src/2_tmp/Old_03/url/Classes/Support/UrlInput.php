<?php


namespace PhpPro\url\Classes\Support;

/**
 * Class UrlInput
 * Класс ввода данных
 * @package PhpPro\url\Classes
 */
class UrlInput
{
    //Метод вводит URL
    /**
     * Метод вводит URL з консоли
     * @return string
     */
    public function inputUrl()
    {
        $this->url=readline("Введіть url починая з http(s)://     ");
        $this->url=trim($this->url);
        if (substr($this->url, -1) != "/"){ //Функция без последнего слеша глючит
            $this->url=$this->url."/";
        }
        return ($this->url);
    }

}