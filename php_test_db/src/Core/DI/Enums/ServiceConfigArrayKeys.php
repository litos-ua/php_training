<?php

namespace Doctor\PhpPro\Core\DI\Enums;

enum ServiceConfigArrayKeys: string
{
    const CLASSNAME = 'class';
    const ARGUMENTS = 'arguments';
    const TAGS = 'tags';
    const CALLS = 'calls';
    const METHOD = 'method';
    const COMPILER = 'compiler';

}