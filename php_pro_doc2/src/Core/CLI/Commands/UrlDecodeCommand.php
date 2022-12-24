<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use Doctor\PhpPro\Shortener\UrlConverter;
use UfoCms\ColoredCli\CliColor;

class UrlDecodeCommand extends AbstractCommand
{
    protected UrlConverter $convertor;

    /**
     * @param UrlConverter $convertor
     */
    public function __construct(UrlConverter $convertor)
    {
        $this->convertor = $convertor;
    }

    protected function runAction(): string
    {
        return 'Shortcode: ' . $this->convertor->decode($this->params[0]);
    }

    public static function getCommandDesc(): string
    {
        return 'Decode shortcode to url';
    }
}
