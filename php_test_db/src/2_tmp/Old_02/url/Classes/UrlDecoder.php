<?php

namespace PhpPro\url\Classes;

use InvalidArgumentException;
use PhpPro\url\Interfaces\IUrlDecoder;


class UrlDecoder implements  IUrlDecoder
{
    protected string $urlName; //Введенный URL или пустая строка при неверном URL
    protected string $repositPath;
    protected object $logger;//Объкт записи в лог

    public function __construct($path,$log)
    {
        $this->logger=$log;//Инструмент записи в лог
        $this->repositPath= $path; //Путь к файлу-хранилищу
    }

    //Метод читает строку из файла, а при его отсутствии выдает сообщение об ошибке
    public function decode(): string
    {

            if (file_exists($path))
            {
                $lines = file($path); // теперь в $lines массив строк файла
                $section=$lines[count($lines)-2].$lines[count($lines)-1];//Вычитываем последние две строки
                $this->urlName=convert_uudecode($section);//Декодируем URL из файла-хранилища
            }
            else {
                $this->urlName = '';
                throw new InvalidArgumentException("помилка декодування");
                $this->logger->error('помилка декодування');

            }
        return $this->urlName;
    }
}

