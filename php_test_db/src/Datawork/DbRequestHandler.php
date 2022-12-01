<?php

namespace Doctor\PhpPro\Datawork;

use PDO;
use PDOException;

class DbRequestHandler
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct($servername,$username,$password,$dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;


        try {
            $dbh = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Подключение к базе данных   ' . $this->dbname . '   произведено успешно' . PHP_EOL;

        } catch(PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
        return $this->dbh = $dbh;
    }

    public function __destruct()
    {
        $dbh = null;
        echo 'Подключение к базе данных   ' . $this->dbname . '   завершено' . PHP_EOL;
    }

    /** Конвертируем sql запрос (убираем разделители)
     * @param string $sql
     * @return string
     */
    public function queryConvert(string $sql):string {
        $sql = str_replace('#', ' ', $sql);
        //echo 'SQL Request:   ' . $sql . PHP_EOL;
        return $sql;
    }

    /** Выполняет запросы типа SELECT
     * @param string $rqw
     * @return string
     */
    public function select (string $rqw):string {
        $selectRqw = $this->dbh->query($rqw)
            ->fetchAll(PDO::FETCH_ASSOC);
        return print_r($selectRqw);
    }
}