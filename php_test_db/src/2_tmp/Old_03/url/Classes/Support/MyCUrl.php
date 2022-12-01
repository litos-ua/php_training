<?php


namespace PhpPro\url\Classes\Support;


class MyCUrl implements \PhpPro\url\Interfaces\Support\IValidateUrl
{

    /**
     * @inheritDoc
     */
    public function getResponseCode(string $url): int
    {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_NOBODY,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_exec($ch);
        $resp = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        return $resp;
    }
}