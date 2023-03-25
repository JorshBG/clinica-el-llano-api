<?php

namespace ElLlano\Api\models;

use PDO;

class Connection
{
private static string $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";port=" . DBPORT . ";charset=utf8mb4";


    public static function getConnection(): PDO
    {
        $conn = new PDO( Connection::$dsn, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}