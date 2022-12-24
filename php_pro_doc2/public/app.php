<?php

use Doctor\PhpPro\Core\CLI\CLIWriter;
use Doctor\PhpPro\Core\DI\Container;
use Doctor\PhpPro\Core\Helpers\SingletonLogger;
use Doctor\PhpPro\Core\WEB\Controllers\UrlController;
use Doctor\PhpPro\Core\WEB\Controllers\UserController;

require_once __DIR__ . '/../vendor/autoload.php';
//$ar_url = parse_url($_SERVER ['REQUEST_URI']);

echo '<br>';
foreach($_GET as $key => $value){
}
/**
 * @var Container $container
 */
$container = require_once __DIR__ . '/../src/bootstrap.php';
$webService='c.user';
If (isset($_GET[$key])) {
    $pathParts=(array) ($_GET[$key]);
    $webService='c.' . $key;
}

$controllerClass = 'Doctor\PhpPro\Core\WEB\Controllers\\' . ucfirst($key) . 'Controller';
$routingMap = [
    UserController::class => 'getUser',
    UrlController::class => 'urlEncoder'
];


try {
    $method = $routingMap[$controllerClass];
    $controllerObject = $container->get($webService);
    echo call_user_func_array([$controllerObject, $method], $pathParts);

} catch (TypeError $e) {
    echo 'Invalid parameter: ' . $e->getMessage();
    die();
} catch (Exception) {
    echo 'Routing not found';
    die();
}
echo '<br>';

/**
 * Эксперименты с commandHandler

if (!Isset($_GET[$key])){
    $argv[0]='public/app.php';
    $argv[1]='my_name';
}
else {
    $argv[0]='public/app.php';
    $argv[1]='url_encode';
    $argv[2]=$_GET[$key];
}
$commandHandler = $container->get('cli.commandHandler');
$commandHandler->handle($argv, function ($params, \Throwable $e) {
    SingletonLogger::error($e->getMessage());
    CLIWriter::getInstance()->setColor(CliColor::RED)
        ->writeLn($e->getMessage());
    CLIWriter::getInstance()->write($e->getFile() . ': ')
        ->writeLn($e->getLine());
});
 */

exit;

