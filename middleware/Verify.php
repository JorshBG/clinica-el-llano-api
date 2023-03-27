<?php

namespace ElLlano\Api\middleware;

use PDO;
use PDOException;

class Verify
{

    private PDO $db;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    /**
     * @throws PDOException
     */
    public function token($content):bool
    {
        $stm = $this->db->prepare('CALL get_token_usuario(:idUsuario)');
        $flag = $stm->execute(['idUsuario'=>$content['idUsuario']]);
        if ($flag)
        {
            $token = ($stm->fetch())['token'];
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