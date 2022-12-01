<?php

namespace MyPhpPro\url;

use InvalidArgumentException;
use MyPhpPro\url\Interfaces\IUrlDecoder;


class UrlDecoder implements  IUrlDecoder
{
    protected string $urlName; //Введенный URL или пустая строка при неверном URL
    protected string $repositPath;

    public function __construct($path)
    {
        $this->repositPath= $path;
    }

    //Метод читает строку из файла, а при его отсутствии выдает сообщение об ошибке
    public function decode(): string
    {

            if (file_exists($this->repositPath))
            {
                $lines = file($this->repositPath); // теперь в $lines массив строк файла
                $section=$lines[count($lines)-2].$lines[count($lines)-1];//Вычитываем последние две строки
                $this->urlName=convert_uudecode($section);//Декодируем URL из файла-хранилища
            }
            else {
                $this->urlName = '';
                throw new InvalidArgumentException("помилка декодування");
            }
        return $this->urlName;
    }
}

