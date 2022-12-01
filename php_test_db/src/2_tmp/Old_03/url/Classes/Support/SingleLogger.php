<?php


namespace PhpPro\url\Classes\Support;


//use Monolog\Logger;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};
use Psr\Log\LoggerInterface;
use Monolog\Handler\AbstractProcessingHandlerHandler;

class SingleLogger
{

    protected static $instance;

    /**
     * @return self
     */
    public static function getInstance(LoggerInterface $logger = null)
    {
        if (!self::$instance) {
            self::$instance = new static($logger);
            if (is_null($logger)) {
                throw new \InvalidArgumentException('Logger is undefined');
            }
            self::$instance = new static($logger);
        }
        return self::$instance;
    }

    protected function __construct( LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function geLogger():LoggerInterface{
        return $this->logger;
    }

    public function pushHandler (\Monolog\Handler\AbstractProcessingHandler $handler):self
    {
        $this->logger->pushHandler($handler);
        return $this;
    }

    protected function __clone(){}
    public function __wakeup()
    {
        $this->acsessDenided(__METHOD__);
    }
    public function __unserialize($array)
    {
        $this->acsessDenided(__METHOD__);
    }

}


