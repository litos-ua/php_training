<?php


namespace Doctor\PhpPro\Core\WEB\Controllers;

use Doctor\PhpPro\Core\ConfigHandler;
use Doctor\PhpPro\Shortener\FileRepository;
use Doctor\PhpPro\Shortener\Helpers\UrlValidator;
use Doctor\PhpPro\Shortener\UrlConverter;
use GuzzleHttp\Client;

require_once __DIR__ . '/../../../../src/bootstrap.php';


class UrlController
{
    public string $url;

    public function __construct(string $url)
    {
       $this->url= $url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function urlEncoder ($url)
    {
        $configs=include __DIR__ . '/../../../../parameters/config.php';
        $configHandler = ConfigHandler::getInstance()->addConfigs($configs);
        $fileRepository = new FileRepository($configHandler->get('dbFile'));
        $urlValidator = new UrlValidator(new Client());
        $converter = new UrlConverter(
            $fileRepository,
            $urlValidator,
            $configHandler->get('urlConverter.codeLength')
        );
        $code = $converter->encode($url);
        echo "Вы ввели Url:   " . $this->url . '<br>';
        return $converter->encode($this->url);
    }
}