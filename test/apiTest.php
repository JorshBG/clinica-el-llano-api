<?php

use ElLlano\Api\middleware\Role;
use ElLlano\Api\models\Connection;

$db = Connection::getConnection();
$id_usuario = Flight::request()->query['idUsuario']??false;

Flight::route('/test1', function (){
    Flight::json(['message'=>'Este es el test 1']);
});



Flight::route('GET /test/db', function() use($db) {
    $query = "CALL get_all_almacenes();";
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
    $params = Flight::request()->query;
    $data = Flight::request()->data->getData();




    // Imprimir la dirección IP del cliente
    Flight::json(["La dirección IP del cliente es: "=>$ip_cliente,'data'=>$data]);


});


Flight::route('GET /api/variables', function () use ($id_usuario) {

    $role_required = "ADMINISTRADOR";

    $validation = Role::validate($id_usuario, $role_required);

    Flight::json(['isValid'=>$validation]);

});

$db = null;