<?php

use ElLlano\Api\middleware\Verify;
use ElLlano\Api\models\Connection;
use Fruitcake\Cors\CorsService;

$token = (getallheaders())['x-api-key']??false;
$id_usuario = Flight::request()->query['idUsuario']??false;
$body = Flight::request()->data->getData();

// region Para obtener información
// Obtener los datos de todos los alamacenes
Flight::route('GET /api/get/almacen', function() use($id_usuario, $token) {
    $query = "CALL get_all_almacenes()";
    try {
        if ($token)
        {
            $flag = Verify::token(array('idUsuario'=>$id_usuario,'token'=>$token));
            if ($flag)
            {
                $db = Connection::getConnection();
                $stm = $db->prepare($query);
                $isGood = $stm->execute();
                if ($isGood){
                    $result = $stm->fetchAll();
                    Flight::json(['result' => $result]);
                }
            } else {
                Flight::json(['message'=>'Sin autorización'], 401);
            }
        }else {
            Flight::json(['message'=>'No se ha provisto un token'], 403);
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor'], 500);
    }
});

// Obtener los datos de todos los productos
Flight::route('GET /api/get/productos', function() use($id_usuario, $token) {
    $query = "CALL get_all_products()";
    try {
        if ($token)
        {
            $flag = Verify::token(array('idUsuario'=>$id_usuario,'token'=>$token));
            if ($flag)
            {
                $db = Connection::getConnection();
                $stm = $db->prepare($query);
                $isGood = $stm->execute();
                if ($isGood){
                    $result = $stm->fetchAll();
                    Flight::json(["result" => $result]);
                }
            } else {
                Flight::json(['message'=>'Sin autorización'], 401);
            }
        }else {
            Flight::json(['message'=>'No se ha provisto un token'], 403);
        }
    } catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

// endregion

// region Para crear nuevos recursos
// Crear un nuevo producto
Flight::route('POST /api/crear/producto', function () use($id_usuario, $body, $token) {
    $query = "CALL set_registrar_producto(:nombre,:unidad_de_compra,:unidad_de_venta,:categoria,:presentacion,:contenido,:descuento,:precio,:sustancia_activa,:descripcion,:ubicacion,:costo_por_unidad,:codigo_de_barras)";
    try {

        if ($token)
        {
            $flag = Verify::token(array('idUsuario'=>$id_usuario,'token'=>$token));
            if ($flag)
            {
                $db = Connection::getConnection();
                $stm = $db->prepare($query);
                $isGood = $stm->execute([
                    "nombre" => $body["nombre"],
                    "unidad_de_compra"=>$body["unidad_de_compra"],
                    "unidad_de_venta"=>$body["unidad_de_venta"],
                    "categoria"=>$body['categoria'],
                    "presentacion"=>$body['presentacion'],
                    "contenido"=>$body['contenido'],
                    "descuento"=>$body['descuento'],
                    "precio"=>$body['precio'],
                    "sustancia_activa"=>$body['sustancia_activa'],
                    "descripcion"=>$body['descripcion'],
                    "ubicacion"=>$body['ubicacion'],
                    "costo_por_unidad"=>$body['costo_por_unidad'],
                    "codigo_de_barras"=>$body['codigo_de_barras']
                ]);
                Flight::json(["isGood" => $isGood], 201);
            } else {
                Flight::json(['message'=>'Sin autorización'], 401);
            }
        }else {
            Flight::json(['message'=>'No se ha provisto un token'], 403);
        }
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});

// Crear un nuevo traslado
Flight::route('POST /api/abrir/traslado', function () use($id_usuario, $body, $token) {
    $query = "CALL op_abrir_traslado(:idProducto,:idAlmacenOrigen,:idAlmacenDestino,:cantidad,:idUsuario)";
    try {
        if ($token && $id_usuario)
        {
            $flag = Verify::token(array('idUsuario'=>$id_usuario,'token'=>$token));
            if ($flag)
            {
                $db = Connection::getConnection();
                $stm = $db->prepare($query);
                $isGood = $stm->execute([
                    "idProducto"=>$body['idProducto'],
                    "idAlmacenOrigen"=>$body['idAlmacenOrigen'],
                    "idAlmacenDestino"=>$body['idAlmacenDestino'],
                    "cantidad"=>$body['cantidad'],
                    "idUsuario"=>$body['idUsuario']
                ]);
                Flight::json(["isGood" => $isGood]);
            } else {
                Flight::json(['message'=>'Sin autorización'], 401);
            }
        }else {
            Flight::json(['message'=>'No se ha provisto un token'], 403);
        }

    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
});
// endregion

// Cerrar un traslado
$db = null;