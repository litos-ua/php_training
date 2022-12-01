<?php

namespace PhpPro\url\Classes\Support;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use PhpPro\url\Interfaces\IValidateUrl;

class MyGuzzle implements \PhpPro\url\Interfaces\IValidateUrl
{
    protected object $client;
    /**
     * @inheritDoc
     */
    public function __construct(ClientInterface $GzClient)
    {
        $this->client=$GzClient;
    }

    public function getResponseCode(string $url): int
    {
        try{
            $response = $this->client->request('GET', $url);
            $resp = $response->getStatusCode();
        }
        catch (ConnectException $exception){

            $resp = 503;
        }
        return (int) $resp;
    }
}