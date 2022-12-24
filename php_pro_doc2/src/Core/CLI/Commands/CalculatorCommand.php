<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use Doctor\PhpPro\Calculator\Calculator;
use UfoCms\ColoredCli\CliColor;

class CalculatorCommand extends AbstractCommand



{
    const NAME = 'calc';

    public function __construct(protected Calculator $calculator)
    {
        parent::__construct();
    }

    //Я добавил, пытаясь устранить ошибку!!!
    protected function runAction(): string
    {
        $this->writer->setColor(CliColor::CYAN)
            ->write('Hello World');
    }

    public function run(array $params = []): void
    {
        parent::run($params);
        $this->writer->setColor(CliColor::CYAN)
            ->write('Result: ')
            ->writeLn(
                $this->calculator->calculate($params[0], $params[1], $params[2])
            );
    }

    public static function getCommandDesc(): string
    {
        return 'Simple cli calculator';
    }
}

