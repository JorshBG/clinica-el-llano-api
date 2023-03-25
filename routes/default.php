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
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute(["email"=>(Flight::request()->data)['email']]);
        if ($isGood){
            if ($stm->rowCount()>0){
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                Flight::json(['result' => $result]);
            } else {
                Flight::json(['message'=>'no hay registros']);
            }
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

$db = null;