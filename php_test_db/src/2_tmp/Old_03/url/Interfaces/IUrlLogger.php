<?php
namespace PhpPro\url\Interfaces;
//Интерфейс для реализации объекта, обрамляющего Logger

/**
 * Interface IUrlLogger
 * @package PhpPro\url\Interfaces
 */

interface IUrlLogger {

    public function uniError ($message);
    public function uniAlert ($message);
    public function uniInfo ($message);

}