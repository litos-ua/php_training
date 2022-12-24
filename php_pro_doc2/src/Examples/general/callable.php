<?php

$request['code'] = 200;
$request['user_agent'] = 'Mozilla';
$request['post'] = [
    'login' => 'vasya',
    'pass' => 'sdfw3w34vfw53vf',
];

$loggerUserData = function () use ($request) {
    $file = fopen('logger.txt', 'a+');
    fwrite($file, implode(' - ', $request['post']) . PHP_EOL);
    fclose($file);
};

unset($request);




$loggerUserData();

exit;