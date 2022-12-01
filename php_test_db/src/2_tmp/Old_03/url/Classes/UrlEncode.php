<?php

namespace PhpPro\url\Classes;

use Exception;
//use http\Exception\UnexpectedValueException;
use PhpPro\url\Interfaces\IUrlEncoder;
use RuntimeException;

/**
 * Class UrlEncode
 * Класс декодирует данные
 * @package PhpPro\url\Classes
 */
class UrlEncode implements IUrlEncoder
{
    protected string $url; //URL для проверки
    //protected object $logger;//Объкт записи в лог
    protected string $repositPath; //Наименование хранилища

    /**
     * UrlEncode constructor.
     * @param $url
     * @param $path
     * @param $log
     */
    public function __construct(
        $url,
        $path
        //$log
    )
    {
      $this->url=$url;//Получаем из вне URL
        //$this->logger=$log;//Инструмент записи в лог
        $this->repositPath=$path; //Путь к файлу-хранилищу
    }


    /**
     * Метод принимает строку (в данном случае url), кодирует ее и записывает в файл-хранилище
     * @param string $furl
     * @return string В результате работы возвращает закодированную строку
     */
    public function encode(string $furl):string
    {
        try {
            $somecontent = convert_uuencode($furl);//Примитивное кодирование строки URL
        }
        catch (RuntimeException $e) {
            throw new \InvalidArgumentException(
              $e->getMessage()
            );
        }
        return($somecontent);
    }
};
