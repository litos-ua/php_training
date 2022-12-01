<?php


namespace PhpPro\WrPdo\Interfaces;


interface IPDO
{
    /**
     * Подключение к БД.
     * @return object
     */
    public static function getDbh():object;

    /**
     * Закрытие соединения.
     */
    public static function destroy();

    /**
     * Получение ошибки запроса
     * @return mixed
     */
    public static function getError();

    /**
     * Возвращает структуру таблицы в виде ассоциативного массива.
     * @param $table
     * @return array
     */
    public static function getStructure($table):array;

    /**
     * Выполняет любой непараметрический запрос типа SELECT и в результате возвращает объект
     * @param $query
     * @return object
     */
    public static function getSelect($query):object;

    /**
     * Выполняет запросы в БД, такие как DELETE, UPDATE, CREATE TABLE и т.д. В случаи успеха возвращает true
     * @param $query
     * @param array $param
     * @return bool
     */
    public static function setData($query, $param = array()):bool;

}

