<?php
$db = \ElLlano\Api\models\Connection::getConnection();

Flight::route('/test1', function (){
    Flight::json(['message'=>'Este es el test 1']);
});



Flight::route('GET /test/db', function() use($db) {
    $query = "CALL get_almacenes();";
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute();
        if ($isGood){
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            Flight::json(['result' => $result]);
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

Flight::route('GET|POST /test/get/ip', function () {

// Obtener la dirección IP del cliente
    $ip_cliente = Flight::request()->ip;

// Imprimir la dirección IP del cliente
    Flight::json(["La dirección IP del cliente es: "=>$ip_cliente]);


});

$db = null;