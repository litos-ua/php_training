<?php

namespace Doctor\PhpPro\Core\Exceptions;

use InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;

class ServiceNotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{

}