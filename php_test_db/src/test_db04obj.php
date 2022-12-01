<?php
// Включаем строгую типизацию
declare(strict_types=1);

use PhpPro\User;

date_default_timezone_set('America/Vancouver');



require_once 'vendor/autoload.php';
require_once __DIR__ . '/../parameters/config_db.php';
require_once 'enc_decr.php';
require_once 'User.php';

//$servername = "host.docker.internal";
$servername = $dbc['connectdb']['servername'];
$username   = $dbc['connectdb']['username'];
$password   = $dbc['connectdb']['password'];
$dbname     = $dbc['connectdb']['dbname'];
//$servername = 'mysql_db';
//$username = 'litos';
//$password ='sysdba';
//$dbname = 'php_pro';



try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDOWR error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
      die('Подключение не удалось: ' . $e->getMessage());
}

/*
try{
    $dbh->query("CREATE TABLE `registr` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `create_at` datetime NOT NULL,
                                 `updated_at` datetime NOT NULL,
                                 `status` smallint NOT NULL DEFAULT '0',
                                 `name` varchar(20) NOT NULL,
                                 `password` varchar(100) NOT NULL,
                                 `banned` tinyint DEFAULT '0',
                          PRIMARY KEY (`id`)\n) ENGINE=InnoDB AUTO_INCREMENT=55 
                          DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci");
} catch(PDOException $e) {
    echo PHP_EOL . $e->getMessage();
}

    $data =    [
                  ['name' =>'Andrew,','user_password' => 'FGH8677jkhjkh'],
                  ['name' =>'Anna',  'user_password' => 'hjgjg76uyty577'],
                  ['name' =>'Alexander','user_password' => 'DFFGHGHJJJ897'],
                  ['name' =>'Victor','user_password' => '78lkjklklj'],
                  ['name' =>'Yaroslav','user_password' => '777HJKlkjlkjlj'],
                  ['name' =>'Karolina','user_password' => 'JHGHJGH777'],
                  ['name' =>'Stepan','user_password' => '333fghstep'],
                  ['name' =>'Barbara','user_password' => '77poipiPPP'],
                  ['name' =>'Ivan','user_password' => 'lkjhlh;'],
                  ['name' =>'Irena','user_password' => '777JKLoiuou798'],
                  ['name' =>'Katarzyna','user_password' => '878HJUTjg99'],
                  ['name' =>'Nikolay','user_password' => 'khhI9hh77'],
                  ['name' =>'Max','user_password' => 'wer567GHJ'],
                  ['name' =>'Robert','user_password' => '777HHH9io'],
                  ['name' =>'Piter','user_password' => '77UYTIoo']
                ];

    foreach($data as $key => $value) {
        $create_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $user_name = $value['name'];
        $user_password = encryptPass($value['user_password']);

        try {
            $sth = $dbh->prepare("INSERT INTO registr (create_at, updated_at, name, password) VALUES
                   ('$create_at','$updated_at','$user_name','$user_password')");
            $sth->execute();
            } catch(PDOException $e) {
                echo PHP_EOL . $e->getMessage();
        }
    }
*/


/*

    $selectRqw01 = $dbh->query("SELECT * FROM registr");//$selectRqw01 - statement
    $selectRqw01->setFetchMode(PDOWR::FETCH_ASSOC);

    echo "SELECT_*_FROM_registr" . PHP_EOL . PHP_EOL;

    while($row = $selectRqw01->fetch()) {
        echo "  id =   " . $row['id'] . PHP_EOL;
        echo "  create_at =   " . $row['create_at'] ;
        echo "  updated_at =   " . $row['updated_at'] . PHP_EOL;
        echo "  status =   " . $row['status'] ;
        echo "  name =   " . $row['name'] ;
        echo "  password =   " . decryptPass($row['password']) ;
        echo "  banned =   " . $row['banned'] . PHP_EOL;
        echo PHP_EOL . PHP_EOL;
    }

    $selectRqw02 = $dbh->query("SELECT * FROM registr WHERE status <> 0")->fetchAll(PDOWR::FETCH_ASSOC);
    echo "SELECT_*_FROM_registr STATUS" . PHP_EOL;
    print_r($selectRqw02);


   echo "Количество входящих параметров:  " . $argc . PHP_EOL;
   echo "Параметр 0:  " . $argv[0] . PHP_EOL;
*/

/*
   if(isset($argv[1])){
        echo "Параметр 1:  " . str_replace('#', ' ', $argv[1]) . PHP_EOL;
        $argv[1]= str_replace('#', ' ', $argv[1]);
        $selectRqw03 = $dbh->query($argv[1])
            ->fetchAll(PDOWR::FETCH_ASSOC);
        echo "SELECT_*_FROM_registr CREATE" . PHP_EOL;
        print_r($selectRqw03);
    }
*/

$dbh = null;


try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

if(isset($argv[1])){
    echo "Параметр 1:  " . str_replace('#', ' ', $argv[1]) . PHP_EOL;
    $argv[1]= str_replace('#', ' ', $argv[1]);
    $allUsers = $dbh->query($argv[1])
        ->fetchAll(PDO::FETCH_CLASS,User::class);
    echo "SELECT_*_FROM_registr CREATE" . PHP_EOL;
    /**
     * @var User[] $allUsers
     */
    echo $allUsers[2]->getId() . PHP_EOL;
    echo $allUsers[2]->getName() . PHP_EOL;
    echo $allUsers[2]->getPassword() . PHP_EOL;
    echo $allUsers[2]->getStatus() . PHP_EOL;
    echo $allUsers[2]->getBanned() . PHP_EOL;
    //print_r($selectRqw03);
}

$dbh = null;

echo PHP_EOL;