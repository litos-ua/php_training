<?php


namespace Doctor\PhpPro\Core\CLI\Commands;

use Doctor\PhpPro\Calculator\Calculator;
use UfoCms\ColoredCli\CliColor;

class CalculatorCommand extends AbstractCommand
{
    const NAME = 'calc';

    protected Calculator $calculator;

    /**
     * @param Calculator $calculator
     */
    public function __construct (Calculator $calculator)
    {
        parent::__construct();
        $this->calculator = $calculator;
    }

    public function run(array $params = []): void
    {
        parent::run($params);
        $this->writer->setColor(CliColor::RED);
        try {
            $this->writer->writeLn('Result  '.
            $this->calculator->calculate($params[0], $params[2], $params[1])
            );
        } catch (\InvalidArgumentException $ex) {
                $ex->getMessage();
                echo 'Some arguments is missing' . PHP_EOL;
        }

    }

    public static function getCommandDesc(): string
    {
        return 'Simple cli calculator';
    }

}