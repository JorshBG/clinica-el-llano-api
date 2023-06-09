<?php

use ElLlano\Api\controllers\Token;
use ElLlano\Api\models\Connection;

$isAjax = Flight::request()->ajax;
$ip = Flight::request()->ip;
$token = $_SERVER['HTTP_X_API_KEY'] ?? false;
$body = Flight::request()->data->getData();


// region Saludos de la api
Flight::route('GET|POST /api/greeting', function (){
    Flight::json(["message"=>"Hola buenas tardes"]);
});

// endregion

// region Validar el usuario y retornar el token
Flight::route('POST /api/validar', function() use($ip, $body) {
    $query = "CALL validar_usuario(:email);";
    $excluir = "password";
    try {
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute(["email"=>$body['email']]);
        if ($isGood){
            if ($stm->rowCount()>0){
                $userResult = $stm->fetch();
                $stm->closeCursor();
                if ($userResult['password'] === md5($body['password'])){
                    $stm=$db->prepare('CALL up_agregar_token(:idUsuario, :token, :ipv4)');
                    $token = Token::getToken(array('email'=>$userResult['correo'], 'password'=>$userResult['password']));
                    $flag = $stm->execute([
                        "idUsuario"=>$userResult['ID'],
                        "token"=>$token,
                        'ipv4'=>$ip
                    ]);


                    $_SESSION['active'] = true;
                    $_SESSION['userID'] =  $userResult['ID'];
                    $_SESSION['userRole'] =  $userResult['Rol'];
                    $_SESSION['userAlmacen'] =  $userResult['Almacen'];

                    $stm->closeCursor();
                    Flight::json(['isValid' => true, 'data'=>array_diff_assoc($userResult, array($excluir => $userResult[$excluir])), 'token'=>$token]);
                } else {
                    Flight::json(['result' => false]);
                }
            } else {
                Flight::json(['message'=>'no hay registros'], 204);
            }
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error'=>$e->getMessage()], 500);
    }
});
// endregion

// region Crear un nuevo usuario
Flight::route('POST /api/crear/usuario', function () use($body){
    try{
        $db = Connection::getConnection();
        $stm = $db->prepare('CALL set_registrar_usuario(:name,:password,:role,:email)');
        $flag = $stm->execute([
            "name"=>$body['nombre'],
            "password"=>md5($body['password']),
            "role"=>$body['rol'],
            "email"=>$body['correo']
        ]);
        if ($flag){
            Flight::json(['message'=>'Se han realizado la inserción','isValid'=>true], 201);
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});
// endregion

// region Cerrar sesión
Flight::route('GET /api/cerrar/sesion', function () use ($ip, $body) {
    $db = Connection::getConnection();
    $stm = $db->prepare("CALL op_cerrar_sesion(:id_usuario, :ip)");
    $flag = $stm->execute(['id_usuario'=>$body['idUsuario'], 'ip'=>$ip]);
});
// endregion

$db = null;