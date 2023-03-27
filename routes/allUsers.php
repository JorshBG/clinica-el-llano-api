<?php

$db = \ElLlano\Api\models\Connection::getConnection();

// Obtener los datos de todos los alamacenes
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

// Obtener los datos de todos los productos
Flight::route('GET /api/get/productos', function() use($db) {
    $query = "CALL get_all_products()";
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute();
        if ($isGood){
            $result = $stm->fetchAll();
            Flight::json(["result" => $result]);
        }
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

// Crear un nuevo producto
Flight::route('POST /api/crear/producto', function () use($db) {
    $query = "CALL set_registrar_producto(:nombre,:unidad_de_compra,:unidad_de_venta,:categoria,:presentacion,:contenido,:descuento,:precio,:sustancia_activa,:descripcion,:ubicacion,:costo_por_unidad,:codigo_de_barras)";
    $data = Flight::request()->data->getData();
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "nombre" => $data["nombre"],
            "unidad_de_compra"=>$data["unidad_de_compra"],
            "unidad_de_venta"=>$data["unidad_de_venta"],
            "categoria"=>$data['categoria'],
            "presentacion"=>$data['presentacion'],
            "contenido"=>$data['contenido'],
            "descuento"=>$data['descuento'],
            "precio"=>$data['precio'],
            "sustancia_activa"=>$data['sustancia_activa'],
            "descripcion"=>$data['descripcion'],
            "ubicacion"=>$data['ubicacion'],
            "costo_por_unidad"=>$data['costo_por_unidad'],
            "codigo_de_barras"=>$data['codigo_de_barras']
        ]);
        Flight::json(["isGood" => $isGood], 201);
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

// Crear un nuevo traslado
Flight::route('POST /api/abrir/traslado', function () use($db) {
    $query = "CALL op_abrir_traslado(:idProducto,:idAlmacenOrigen,:idAlmacenDestino,:cantidad,:idUsuario)";
    $data = Flight::request()->data->getData();
    try {
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "idProducto"=>$data['idProducto'],
            "idAlmacenOrigen"=>$data['idAlmacenOrigen'],
            "idAlmacenDestino"=>$data['idAlmacenDestino'],
            "cantidad"=>$data['cantidad'],
            "idUsuario"=>$data['idUsuario']
        ]);
        Flight::json(["isGood" => $isGood]);
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

// Cerrar un traslado
$db = null;