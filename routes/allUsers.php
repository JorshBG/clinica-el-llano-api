<?php

$db = \ElLlano\Api\models\Connection::getConnection();

Flight::route('GET /api/get/almacen', function() use($db) {
    $query = "CALL get_all_almacenes()";
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

Flight::route('GET /api/get/productos', function() use($db) {
    $query = "CALL get_all_products()";
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute();
        if ($isGood){
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            Flight::json(["result" => $result]);
        }
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

$db = null;