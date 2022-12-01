<?php


namespace PhpPro\WrPdo;



use Exception;
use PDO;
use PDOException;
use PhpPro\WrPdo\Interfaces\IPDO;
use PhpPro\User;

/**
 * Class PDOWR is wrapper for working with PDO
 * @package PhpPro\WrPdo
 */
class PDOWR implements IPDO
{
    public static $dsn = 'mysql:dbname=php_pro;host=mysql_db';
    public static $user = 'litos';
    public static $pass = 'sysdba';

    /**
     * Объект PDOWR.
     */
    public static $dbh = null;

    /**
     * Statement Handle.
     */
    public static $sth = null;

    /**
     * Выполняемый SQL запрос.
     */
    public static $query = '';

    /**
     * Подключение к БД.
     */
    public static function getDbh():object
    {
        if (!self::$dbh) {
            try {
                self::$dbh = new PDO(
                    self::$dsn,
                    self::$user,
                    self::$pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (PDOException $e) {
                exit('Error connecting to database: ' . $e->getMessage());
            }
        }

        return self::$dbh;
    }

    /**
     * Закрытие соединения.
     */
    public static function destroy()
    {
        self::$dbh = null;
        return self::$dbh;
    }

    /**
     * Получение ошибки запроса.
     */
    public static function getError()
    {
        $info = self::$sth->errorInfo();
        return (isset($info[2])) ? 'SQL: ' . $info[2] : null;
    }

    /**
     * Выполняет любой непараметрический запрос типа SELECT и в результате возвращает объект.
     * @param $query
     * @return object
     */

    public static function getSelect($query):object
    {
        return (object) self::$dbh->query($query)->fetchAll(PDO::FETCH_CLASS,User::class);
    }

    /**
     * Выполняет подготовленный запрос с параметром типа SELECT и в результате возвращает объект.
     * @param $query
     * @param array $param
     * @return object
     */
    public static function getParamSelect($query, $param = array()):object
    {
        try {
            if ($param) {
                self::$sth = self::getDbh()->prepare($query);
                self::$sth->execute((array)$param);
            }
        }
        catch (PDOException $e){
            throw new Exception($e->getMessage());
        }
        return (object) self::$sth->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * Возвращает структуру таблицы в виде ассоциативного массива.
     */
    public static function getStructure($table):array
    {
        $res = array();
        foreach (self::getAll("SHOW COLUMNS FROM {$table}") as $row) {
            $res[$row['Field']] = (is_null($row['Default'])) ? '' : $row['Default'];
        }

        return $res;
    }

    /**
     * Добавление в таблицу, в случаи успеха вернет вставленный ID, иначе 0.
     */
    public static function add($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        return (self::$sth->execute((array) $param)) ? self::getDbh()->lastInsertId() : 0;
    }



    /**
     * Получение строки из таблицы.
     */
    public static function getRow($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Получение всех строк из таблицы.
     */
    public static function getAll($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получение значения.
     */
    public static function getValue($query, $param = array(), $default = null)
    {
        $result = self::getRow($query, $param);
        if (!empty($result)) {
            $result = array_shift($result);
        }

        return (empty($result)) ? $default : $result;
    }

    /**
     * Получение столбца таблицы.
     */
    public static function getColumn($query, $param = array())
    {
        self::$sth = self::getDbh()->prepare($query);
        self::$sth->execute((array) $param);
        return self::$sth->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Выполняет запросы в БД, такие как DELETE, UPDATE, CREATE TABLE и т.д. В случаи успеха возвращает true.
     * @param $query
     * @param array $param
     * @return bool
     */
    public static function setData($query, $param = array()):bool
    {
        self::$sth = self::getDbh()->prepare($query);
        return (bool) self::$sth->execute((array) $param);
    }
}