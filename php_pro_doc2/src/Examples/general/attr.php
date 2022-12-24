<?php

function foo(int $a = null)
{
    if (is_null($a)) {
        echo 'ERROR';
    }
    echo $a;
}

foo(3); // 3
foo(4); // 4
foo(); // ERROR



