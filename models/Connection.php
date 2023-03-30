<?php

namespace ElLlano\Api\models;

use Exception;
use Flight;
use PDO;
use PDOException;

class Connection
{
private static string $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";port=" . DBPORT . ";charset=utf8mb4";
private static PDO $conn;

    /**
     * @throws PDOException
     */
    public static function create(): void
    {
        try{
            self::$conn = new PDO( Connection::$dsn, DBUSER, DBPASS);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $ext){
            Flight::error($ext);
        }
    }

    public static function getConnection():PDO
    {
        return self::$conn;
    }
}