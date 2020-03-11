<?php namespace Database;

use PDO;
use Throwable;

class ConnectMySQL
{

    private static $info = [
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => '',
        'database' => 'managerdb',
    ];

    private static $connection = null;

    /**
     * get a instance connection mysql
     *
     * @return PDO
     */
    public static function getConnection()
    {
        try {
            if (!self::$connection){
                $string_connection = join([
                    'mysql:host=', self::$info['host'], ';',
                    'dbname=', self::$info['database'], ';',
                    'charset=utf8'
                ]);
        
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
    
                self::$connection = new PDO($string_connection, self::$info['user'], self::$info['password'], $options);
            }
        } catch (Throwable $th) {
            return null;
        }

        return self::$connection;
    }

    public static function beginTransaction()
    {
        self::getConnection()->beginTransaction();
    }

    public static function rollBackTransaction()
    {
        self::getConnection()->rollBack();
    }

    public static function commitTransaction()
    {
        self::getConnection()->commit();
    }
}
