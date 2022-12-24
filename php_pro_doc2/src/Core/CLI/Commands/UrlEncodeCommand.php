<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use Doctor\PhpPro\Shortener\UrlConverter;
use UfoCms\ColoredCli\CliColor;

class UrlEncodeCommand extends AbstractCommand
{
    protected UrlConverter $convertor;
    public $url;

    /**
     * @param UrlConverter $convertor
     */
    public function __construct(UrlConverter $convertor)
    {
        $this->convertor = $convertor;
    }

    /**
     * @inheritDoc
     */
    //protected function runAction(): string
    public function runAction(): string
    {
        return 'Shortcode: ' . $this->convertor->encode($this->params[0] ?? '');
        //return 'Shortcode: ' . $this->convertor->encode('https://packagist.org');
    }

    /**
     * @inheritDoc
     */
    public static function getCommandDesc(): string
    {
        return 'Encode the url to short code';
    }



}
