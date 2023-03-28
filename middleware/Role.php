<?php

namespace ElLlano\Api\middleware;

use ElLlano\Api\models\Connection;
use PDOException;

class Role
{
    /**
     * @throws PDOException
     */
    public static function validate($id_user, $role_required):bool
    {
        $conn = Connection::getConnection();
        $stm = $conn->prepare('CALL get_rol(:idUsuario)');
        $wasGood = $stm->execute(['idUsuario'=>$id_user]);
        if ($wasGood && $stm->rowCount()>0){
            if (($stm->fetch())['rol'] === $role_required)
            {
                return true;
            }
        }
        return false;
    }
}