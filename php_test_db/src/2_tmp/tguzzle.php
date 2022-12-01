<?php
//namespace PhpPro\url;
//namespace PhpPro;
//namespace GuzzleHttp;
//require_once 'vendor\guzzlehttp\guzzle\src\Client.php';
chdir(dirname(__DIR__));

 require_once 'vendor/autoload.php';

 use Guzzle\Http\Client;
 use Guzzle\Http\EntityBody;
 use Guzzle\Http\Message\Request;
 use Guzzle\Http\Message\Response;

$url='http://www.yahoo.com/';

require_once 'vendor/autoload.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $url);

echo 'Status code =  ' . $response->getStatusCode() . PHP_EOL; // 200

if ($url[4]=='s'){
    $url = trim(str_replace('https://', '', $url));
} else{
    $url = trim(str_replace('http://', '', $url));
}
$ip=gethostbyname( $url). PHP_EOL;
echo "IP адреса хоста  ". $url. " :  " . $ip;

//https://api.github.com/repos/guzzle/guzzle

//echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
//echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
//'https://api.github.com/repos/guzzle/guzzle'