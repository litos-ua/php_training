<?php
// Включаем строгую типизацию
declare(strict_types=1);




//$servername = "host.docker.internal";
$servername="mysql_db";
$username = "litos";
$password = "sysdba";
$dbname = "php_pro";

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDOWR error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $selectRqw01 = $dbh->query("SELECT * FROM registr");//$selectRqw01 - statement
    $selectRqw01->setFetchMode(PDO::FETCH_ASSOC);

    echo "SELECT_*_FROM_registr" . PHP_EOL . PHP_EOL;

    while($row = $selectRqw01->fetch()) {
        echo "id =   " . $row['id'] . PHP_EOL;
        echo "create_at =   " . $row['create_at'] ;
        echo "updated_at =   " . $row['updated_at'] . PHP_EOL;
        echo "status =   " . $row['status'] ;
        echo "name =   " . $row['name'] ;
        echo "password =   " . $row['password'] ;
        echo "banned =   " . $row['banned'] . PHP_EOL;
        echo PHP_EOL . PHP_EOL;
    }

    $selectRqw02 = $dbh->query("SELECT * FROM registr WHERE status <> 0")->fetchAll(PDO::FETCH_ASSOC);
    echo "SELECT_*_FROM_registr STATUS" . PHP_EOL;
    print_r($selectRqw02);

    $selectRqw03 = $dbh->query("SELECT * FROM registr WHERE MONTH(create_at) = 10")
        ->fetchAll(PDO::FETCH_ASSOC);
    echo "SELECT_*_FROM_registr CREATE" . PHP_EOL;
    print_r($selectRqw03);

} catch(PDOException $e) {
    $e->getMessage();
}

$dbh = null;

echo PHP_EOL;