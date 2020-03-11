<?php namespace Database;

use PDO;

class BaseDAO
{

    public static function select(String $querySql, array $paramns = [])
    {
        if ($pdo = ConnectMySQL::getConnection()){
            $stmt = $pdo->prepare($querySql);
            $stmt->execute($paramns);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        return [];
    }

    public static function insert(String $querySql, array $paramns = [])
    {
        if ($pdo = ConnectMySQL::getConnection()){
            $stmt = $pdo->prepare($querySql);
            $stmt->execute($paramns);

            return $stmt->rowCount() > 0 ? $pdo->lastInsertId() : false;
        }

        return false;
    }

    public static function update(String $querySql, array $paramns = [])
    {
        if ($pdo = ConnectMySQL::getConnection()){
            $stmt = $pdo->prepare($querySql);
            $stmt->execute($paramns);

            return $stmt->rowCount();
        }

        return false;
    }

    public static function execute(String $querySql, array $paramns = [])
    {
        if ($pdo = ConnectMySQL::getConnection()){
            $stmt = $pdo->prepare($querySql);

            $stmt->execute($paramns);

            return $stmt;
        }

        return false;
    }

}
