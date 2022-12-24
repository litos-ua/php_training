<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use UfoCms\ColoredCli\CliColor;

class TestCommand extends AbstractCommand
{
    protected function runAction(): string
    {
        $this->writer->writeLn('Hello World');
        return '';
    }

    public static function getCommandDesc(): string
    {
        return 'This command demonstrates a simple use of the CLI';
    }
}
