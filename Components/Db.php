<?php

class Db
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {
            return self::$instance = self::setConnection();
        }
        return self::$instance;
    }

    private static function setConnection()
    {
        $paramsPath = __DIR__ . '/../config/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        return self::$instance = new PDO($dsn, $params['user'], $params['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
    }

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
