<?php

namespace ElLlano\Api\middleware;

use PDOException;
use ElLlano\Api\models\Connection;
class Verify
{

    /**
     * @throws PDOException
     */
    public static function token($content):bool
    {
        $db = Connection::getConnection();

        $stm = $db->prepare('CALL get_token_usuario(:idUsuario)');
        $flag = $stm->execute(['idUsuario'=>$content['idUsuario']]);
        if ($flag)
        {
            $token = ($stm->fetch())['token'];
            $stm->closeCursor();
            $db=null;
            if ($token)
            {
                if ($token === $content['token'])
                {
                    return true;
                }
            }
        }
        return false;
    }

}