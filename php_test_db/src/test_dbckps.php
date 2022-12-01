<?php
use PhpPro\User;

date_default_timezone_set('America/Vancouver');



require_once 'vendor/autoload.php';
require_once __DIR__ . '/../parameters/config_db.php';
require_once 'enc_decr.php';
require_once 'User.php';

$servername = $dbc['connectdb']['servername'];
$username   = $dbc['connectdb']['username'];
$password   = $dbc['connectdb']['password'];
$dbname     = $dbc['connectdb']['dbname'];

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "База данных   " . $dbname . "   подключена" . PHP_EOL;

} catch(PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}


    $userLogin = trim(readline('Input your login:  '));
    $inputPassword = trim(readline('Input your password:  '));
    echo PHP_EOL;

/*
    //Образец
    $st = $pdo->prepare('SELECT * FROM user WHERE id=:id');
    $id = 2;
    $st->bindParam(':id', $id, PDOWR::PARAM_INT);
    $st->execute();
    $r = $st->fetchAll();
*/

    $squery = $dbh->prepare("SELECT * FROM registr WHERE name = :username");
    $squery->bindParam(':username', $userLogin,PDO::PARAM_STR);
    $squery->execute();
    $allUsers = $squery ->fetchAll(PDO::FETCH_CLASS,User::class);

     echo $inputPassword . PHP_EOL;
     $tmppass= trim(decryptPass($allUsers[0]->getPassword()));
     echo $tmppass. PHP_EOL;
    if (!empty ($allUsers) && $inputPassword == $tmppass){        //!empty ($allUsers) && password_verify($inputPassword,$tmppass)
     echo "sucsess id for {$allUsers[0]->getName()}   " . PHP_EOL;
     } else{
        echo "fail autofication" . PHP_EOL;
    }


//    /**
//     * @var User[] $allUsers
//     */
//    echo $allUsers[0]->getId() . PHP_EOL;
//    echo $allUsers[0]->getName() . PHP_EOL;
//    echo $allUsers[0]->getPassword() . PHP_EOL;
//    echo $allUsers[0]->getStatus() . PHP_EOL;
//    echo $allUsers[0]->getBanned() . PHP_EOL;



$dbh = null;
