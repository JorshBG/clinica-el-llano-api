<?php

$db = \ElLlano\Api\models\Connection::getConnection();

Flight::route('GET /api/greeting', function (){
    Flight::json(["message"=>"Hola buenas tardes"]);
});

Flight::route('GET /', function (){
    Flight::json(["message"=>"Hola buenas tardes"]);
});


Flight::route('POST /api/validar', function() use($db) {
    $query = "CALL validar_usuario(:email);";
    $excluir = "password";
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute(["email"=>(Flight::request()->data)['email']]);
        if ($isGood){
            if ($stm->rowCount()>0){
                $result = $stm->fetch(PDO::FETCH_ASSOC);
                if ($result['password'] === md5((Flight::request()->data)['password'])){
                    Flight::json(['isValid' => true, 'data'=>array_diff_assoc($result, array($excluir => $result[$excluir]))]);
                } else {
                    Flight::json(['result' => false]);
                }
            } else {
                Flight::json(['message'=>'no hay registros']);
            }
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

Flight::route('POST /api/create/user', function () use($db){
    $data = Flight::request()->data->getData();
    try{
        $stm = $db->prepare('CALL ');
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

$db = null;