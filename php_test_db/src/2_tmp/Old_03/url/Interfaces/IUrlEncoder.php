<?php
namespace PhpPro\url\Interfaces;

use InvalidArgumentException;
interface IUrlEncoder
//Метод принимает строку, кодирует ее и записывает в файл-хранилище
//Реализовано в классе RealUrlEncode
{
    /**
     * @param  string $url
     * @throws InvalidArgumentException
     * @return string
     */
    public function encode( string $url):string;
}


