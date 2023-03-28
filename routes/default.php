<?php

$db = \ElLlano\Api\models\Connection::getConnection();
$isAjax = Flight::request()->ajax;
$ip = Flight::request()->ip;
$header = getallheaders();
$data = Flight::request()->data->getData();

use ElLlano\Api\controllers\Token;

Flight::route('GET /api/greeting', function (){
    Flight::json(["message"=>"Hola buenas tardes"]);
});

Flight::route('GET /', function (){
    Flight::json(["message"=>"Hola buenas tardes"]);
});


Flight::route('POST /api/validar', function() use($ip, $db, $data) {
    $query = "CALL validar_usuario(:email);";
    $excluir = "password";
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute(["email"=>$data['email']]);
        if ($isGood){
            if ($stm->rowCount()>0){
                $userResult = $stm->fetch();
                $stm->closeCursor();
                if ($userResult['password'] === md5($data['password'])){
                    $stm=$db->prepare('CALL up_agregar_token(:idUsuario, :token, :ipv4)');
                    $token = Token::getToken(array('email'=>$userResult['correo'], 'password'=>$userResult['password']));
                    $flag = $stm->execute([
                        "idUsuario"=>$userResult['ID'],
                        "token"=>$token,
                        'ipv4'=>$ip
                    ]);
                    $stm->closeCursor();
                    Flight::json(['isValid' => true, 'data'=>array_diff_assoc($userResult, array($excluir => $userResult[$excluir])), 'token'=>$token]);
                } else {
                    Flight::json(['result' => false]);
                }
            } else {
                Flight::json(['message'=>'no hay registros']);
            }
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error'=>$e->getMessage()], 500);
    }
});

Flight::route('POST /api/crear/usuario', function () use($db){
    $data = Flight::request()->data->getData();
    try{
        $stm = $db->prepare('CALL set_registrar_usuario(:name,:password,:role,:email)');
        $flag = $stm->execute([
            "name"=>$data['nombre'],
            "password"=>md5($data['password']),
            "role"=>$data['rol'],
            "email"=>$data['correo']
        ]);
        if ($flag){
            Flight::json(['message'=>'Se han realizado la inserción','isValid'=>true], 201);
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

$db = null;