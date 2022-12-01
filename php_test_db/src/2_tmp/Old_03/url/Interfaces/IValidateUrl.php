<?php
namespace PhpPro\url\Interfaces;

interface IValidateUrl{

    /**
     * @param string $url
     * @return int
     */
    public function getResponseCode (string $url): int;

}