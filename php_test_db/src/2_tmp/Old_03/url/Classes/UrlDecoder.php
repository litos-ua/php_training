<?php

namespace PhpPro\url\Classes;

use InvalidArgumentException;
use ParseError;
use PhpPro\url\Interfaces\IUrlDecoder;

/**
 * Class UrlDecoder
 *
 * @package PhpPro\url\Classes
 */
class UrlDecoder implements  IUrlDecoder
{
    protected string $urlName; //Введенный URL или пустая строка при неверном URL
    protected string $repositPath;
    //protected object $logger;//Объкт записи в лог

    public function __construct($path)
    {
        //$this->logger=$log;//Инструмент записи в лог
        $this->repositPath= $path; //Путь к файлу-хранилищу
    }

    /**
     * Метод декодирует строку из репозитория
     * @param string $code
     * @return string
     */
    public function decode(string $code): string{
        try {
            $decodUrl = convert_uudecode($code);//Декодируем URL из файла-хранилища
        }
        catch (ParseError $e) {
            throw new \InvalidArgumentException(
                $e->getMessage()
            );
        }
        return $decodUrl;
    }

}

