<?php


namespace PhpPro\Core\CLI\Commands;
use Doctor\PhpPro\Datawork\DbRequestHandler;
use UfoCms\ColoredCli\CliColor;


class DbRequestCommand extends \Doctor\PhpPro\Core\CLI\Commands\AbstractCommand
{

    protected DbRequestHandler $dbr;

    /**
     * DbRequestCommand constructor.
     * @param DbRequestHandler $dbr
     */
    public function __construct(DbRequestHandler $dbr)
    {
        parent::__construct();
        $this->dbr = $dbr;
    }


    /**
     * @param array $params
     * @throws \Doctor\PhpPro\Core\CLI\Exceptions\CliCommandException
     */
    public function run(array $params = []): void
    {
        parent::run($params);
        $rqw = $this->dbr->queryConvert($params[0]);
        $this->writer->setColor(CliColor::RED)->writeLn('SQL Request:  '.$rqw);
        $this->writer->setColor(CliColor::LIGHT_BLUE)->writeLn($this->dbr->select($rqw));
    }

    public static function getCommandDesc(): string
    {
        return 'This command executes the request';
    }
}