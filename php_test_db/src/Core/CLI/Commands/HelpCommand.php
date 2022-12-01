<?php

namespace Doctor\PhpPro\Core\CLI\Commands;

use Doctor\PhpPro\Core\CLI\Exceptions\CliCommandException;
use Doctor\PhpPro\Core\CLI\Interfaces\ICliCommand;
use UfoCms\ColoredCli\CliColor;

class HelpCommand extends AbstractCommand
{
    /**
     * @var ICliCommand[]
     */
    protected array $allowedCommands = [];

    /**
     * HelpCommand constructor.
     * @param array $allowedCommands
     */
    public function __construct(array $allowedCommands = [])
    {
        parent::__construct();
        $this->allowedCommands[] = $this;
        $this->allowedCommands = array_merge($this->allowedCommands, $allowedCommands);
    }

    /**
     * @return string
     */
    public static function getCommandDesc(): string
    {
        return 'Print help message';
    }

    /**
     * @param array $params
     * @throws CliCommandException
     * @return void
     */
    public function run(array $params = []): void
    {
        parent::run($params);
        $this->writer->setColor(CliColor::CYAN);
        $this->writer->writeLn( "Allowed commands:");
        /**
         * @var ICliCommand $command
         */
        foreach ($this->allowedCommands as $command) {
            $this->writer->writeLn($command::getCommandName() . ' - ' . $command::getCommandDesc());
        }
    }
}
