<?php

namespace ElLlano\Api\models;

use PDO;

class Connection
{
    public static function getConnection(): PDO
    {
        $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";port=" . DBPORT , DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}