<?php

namespace Doctor\PhpPro\Core\Exceptions;

use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;

class ContainerException extends InvalidArgumentException implements ContainerExceptionInterface
{

}
