<?php

use Doctor\PhpPro\Calculator\Actions\Div;
use Doctor\PhpPro\Calculator\Actions\Expo;
use Doctor\PhpPro\Calculator\Actions\Multi;
use Doctor\PhpPro\Calculator\Actions\Sub;
use Doctor\PhpPro\Calculator\Actions\Sum;

use Doctor\PhpPro\Calculator\SmartCalculator;

require_once __DIR__ . '/../vendor/autoload.php';
//require_once 'calc.php';

function separator()
{
    return str_repeat('*', 70) . PHP_EOL;
}

$calculator = new SmartCalculator();

try {

    $calculator->actionRegistration(new Sum())
        ->actionRegistration(new Sub())
        ->actionRegistration(new Multi())
        ->actionRegistration(new Expo())
        ->actionRegistration(new Div())
    ;

} catch (Exception $e) {
    echo $e->getMessage();
    echo separator();
    exit;
} catch (\Error $err) {
    echo $err->getMessage();
    echo separator();
    exit;
}

echo separator();
echo 'Консольний калькулятор' . PHP_EOL;
echo 'Введіть простий вираз для обчислення двох чисел' . PHP_EOL;
echo 'Наприклад: 5 * 2' . PHP_EOL;
echo 'Доступні дії: ' . implode(', ', $calculator->getCalculatePossibilities()) . PHP_EOL;
echo separator();


$inputData = readline('Введіть вираз: ');
try {
    $result = $calculator->calculateExpression($inputData);
    echo 'Результат: ' . $inputData . ' = ' . $result . PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage();
} catch (\Error $err) {
    echo $err->getMessage();
}
echo PHP_EOL;
echo separator();
