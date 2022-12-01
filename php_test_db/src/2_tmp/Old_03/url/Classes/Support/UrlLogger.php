<?php
namespace PhpPro\url\Classes\Support;
use Monolog\ {
    Level,
    Logger,
    Handler\StreamHandler
};
use PhpPro\url\Interfaces\IUrlLogger;


//Этот класс обрамляет сверху Logger для удобства корректировки в дальнейшем
class UrlLogger implements IUrlLogger
{
    protected string $pathe;
    protected string $pathi;
    protected string $patha;

    public function __construct(){
        $this->pathe= __DIR__ .'../../log/my_error.log';
        $this->pathi= __DIR__ .'../../log/my_info.log';
        $this->patha= __DIR__ .'../../log/my_alert.log';
        $this->log=new Logger('litos');
    }
    public function uniError ($message){
        $this->log->pushHandler(new StreamHandler($this->pathe, Level::Error));
        $this->log->error($message);
    }
    public function uniAlert ($message){
        $this->log->pushHandler(new StreamHandler($this->patha, Level::Alert));
        $this->log->alert($message);
    }

    public function uniInfo ($message){

        $this->log->pushHandler(new StreamHandler($this->pathi, Level::Info));
        $this->log->info($message);
    }
}