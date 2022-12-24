<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use UfoCms\ColoredCli\CliColor;

class MyNameCommand extends AbstractCommand
{
//    public function run(array $params = []): void
//    {
//        parent::run($params);
//        $this->writer->setColor(CliColor::YELLOW)->writeLn('I am Andrzej Litkiewicz');
//    }

    protected function runAction(): string
    {
        $this->writer->setColor(CliColor::YELLOW)->writeLn('I am Andrzej Litkiewicz');
        return '';
    }

    public static function getCommandDesc(): string
    {
        return 'This command displays on the screen my name';
    }
}