<?php
namespace MyPhpPro\url\Interfaces;

interface IUrlDecoder
{
    /**
     * @param string $code
     * @throws \InvalidArgumentException
     * @return string
     */
    public function decode(): string;
}