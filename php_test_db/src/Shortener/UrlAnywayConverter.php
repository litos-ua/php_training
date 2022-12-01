<?php

namespace Doctor\PhpPro\Shortener;

class UrlAnywayConverter extends UrlConverter
{
    /**
     * @param string $url
     * @return string
     */
    public function encode(string $url): string
    {
        $this->validateUrl($url);
        return $this->generateAndSaveCode($url);
    }
}