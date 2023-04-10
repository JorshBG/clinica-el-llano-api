<?php

use ElLlano\Api\middleware\Verify;
use ElLlano\Api\models\Connection;
use Fruitcake\Cors\CorsService;

$token = $_SERVER['HTTP_X_API_KEY'] ?? false;
$id_usuario = Flight::request()->query['idUsuario'] ?? false;
$body = Flight::request()->data->getData();
$ip = Flight::request()->ip;

function constraintWithoutRole($token, $id_usuario, $callback): void
{
    try {
        $callback();
        // if ($token) {
        //     $flag = Verify::token(array('idUsuario' => $id_usuario, 'token' => $token));
        //     if (true) {
        //         $callback();
        //     } else {
        //         Flight::json(['message' => 'Sin autorización'], 401);
        //     }
        // } else {
        //     Flight::json(['message' => 'No se ha provisto un token'], 403);
        // }
    } catch (PDOException|Exception $e) {
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'debug' => $e->getMessage()], 500);
    }
}

// region Para obtener información
// Obtener los datos de todos los alamacenes
Flight::route('GET /api/get/almacen', function () use ($id_usuario, $token) {

    $execution = function () {
        $query = "CALL get_all_almacenes()";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute();
        if ($isGood) {
            $result = $stm->fetchAll();
            Flight::json(['result' => $result]);
        } else {
            Flight::json(['message' => 'No hay almacenes']);
        }
    };

    constraintWithoutRole($token, $id_usuario, $execution);

});

// Obtener los datos de todos los productos
Flight::route('GET /api/dashboard/views/catalogo/productos', function () use ($id_usuario, $token) {

    $execution = function () {
        $query = "CALL get_all_products()";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute();
        if ($isGood) {
            $result = $stm->fetchAll();
            Flight::json(["result" => $result]);
        }
    };

    constraintWithoutRole($token, $id_usuario, $execution);
});

Flight::route('GET /api/get/total/producto/almacen', function() use($token, $id_usuario)
{
    $execution = function()
    {
        $query = "CALL get_cantidad_total_de_producto_en_alamacen(:idProducto, :idAlmacen)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "idProducto" => Flight::request()->query['idProducto'],
            "idAlmacen" => Flight::request()->query['idAlmacen']
        ]);
        if ($isGood) {
            $result = $stm->fetchAll();
            Flight::json(["result" => $result]);
        }
        $stm->closeCursor();
    };
    constraintWithoutRole($token, $id_usuario, $execution);
});

Flight::route('GET /api/get/productos/por/almacen', function() use($token, $id_usuario)
{
    $execution = function()
    {
        $query = "CALL get_all_productos_por_almacen(:idAlmacen)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "idAlmacen" => Flight::request()->query['idAlmacen']
        ]);
        if ($isGood) {
            $result = $stm->fetchAll();
            $stm->closeCursor();
            Flight::json(["result" => $result]);
        }

    };
    constraintWithoutRole($token, $id_usuario, $execution);
});


Flight::route('GET /api/get/total/producto/general', function() use($token, $id_usuario)
{
    $execution = function()
    {
        $query = "CALL get_cantidad_total_de_producto_en_general(:idProducto)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "idProducto" => Flight::request()->query['idProducto']
        ]);
        if ($isGood) {
            $result = $stm->fetchAll();
            $stm->closeCursor();
            Flight::json(["result" => $result]);
        }
    };
    constraintWithoutRole($token, $id_usuario, $execution);
});

Flight::route('GET /api/get/menus', function() use($token,$id_usuario)
{
    $execution = function() use($id_usuario)
    {
        $queryRol = "CALL get_rol(:idUsuario)";
        $db = Connection::getConnection();
        $stm = $db->prepare($queryRol);
        $stm->execute(['idUsuario'=>$id_usuario]);
        $role = $stm->fetch() ?? false;
//        Flight::json(['result'=>$role['rol']]);
        if ($role){
            $stm->closeCursor();
            $queryMenu = "CALL get_all_menus(:roleID)";
            $stm = $db->prepare($queryMenu);
            $stm->execute(['roleID'=>$role['rolID']]);
            $result = $stm->fetchALL();
            Flight::json(['result'=>$result]);
        }

    };

    constraintWithoutRole($token, $id_usuario, $execution);
});

// endregion

// region Para crear nuevos recursos
// Crear un nuevo producto
Flight::route('POST /api/crear/producto', function () use ($id_usuario, $body, $token) {


    $execution = function () use ($body) {
        $query = "CALL set_registrar_producto(:nombre,:unidad_de_compra,:unidad_de_venta,:categoria,:presentacion,:contenido,:descuento,:precio,:sustancia_activa,:descripcion,:ubicacion,:costo_por_unidad,:codigo_de_barras)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "nombre" => $body["nombre"],
            "unidad_de_compra" => $body["unidad_de_compra"],
            "unidad_de_venta" => $body["unidad_de_venta"],
            "categoria" => $body['categoria'],
            "presentacion" => $body['presentacion'],
            "contenido" => $body['contenido'],
            "descuento" => $body['descuento'],
            "precio" => $body['precio'],
            "sustancia_activa" => $body['sustancia_activa'],
            "descripcion" => $body['descripcion'],
            "ubicacion" => $body['ubicacion'],
            "costo_por_unidad" => $body['costo_por_unidad'],
            "codigo_de_barras" => $body['codigo_de_barras']
        ]);
        Flight::json(["isGood" => $isGood], 201);
    };

    constraintWithoutRole($token, $id_usuario, $execution);
});

// Crear un nuevo traslado
Flight::route('POST /api/abrir/traslado', function () use ($id_usuario, $body, $token) {


    $execution = function () use ($body) {
        $query = "CALL op_abrir_traslado(:idProducto,:idAlmacenOrigen,:idAlmacenDestino,:cantidad,:idUsuario)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "idProducto" => $body['idProducto'],
            "idAlmacenOrigen" => $body['idAlmacenOrigen'],
            "idAlmacenDestino" => $body['idAlmacenDestino'],
            "cantidad" => $body['cantidad'],
            "idUsuario" => $body['idUsuario']
        ]);
        $stm->closeCursor();
        Flight::json(["isGood" => $isGood], 201);
    };

    constraintWithoutRole($token, $id_usuario, $execution);
});
// endregion

// region Actualizaciones y operaciones extra
// Responder
Flight::route('PUT /api/cerrar/traslado', function () use ($token, $id_usuario, $body) {
    $execution = function () use ($body) {
        $query = "CALL op_cerrar_traslado(:idProceso,:ipv4,:respuesta)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $flag = $stm->execute([
            "idProceso" => $body['idProceso'],
            "ipv4" => $body['ipv4'],
            "respuesta" => $body['respuesta']
        ]);
        $stm->closeCursor();
        Flight::json(['operation' => $flag]);
    };

    constraintWithoutRole($token, $id_usuario, $execution);
});


Flight::route('PUT /api/operacion/traslado', function () use ($ip, $token, $id_usuario, $body) {
    $execution = function () use ($ip, $body, $id_usuario) {
        $query = "CALL op_trabajar_traslado(:idUsuario, :ipv4, :idTraslado, :respuesta)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $flag = $stm->execute([
            "idUsuario" => $id_usuario,
            "ipv4" => $ip,
            "idTraslado" => $body['idTraslado'],
            "respuesta" => $body['respuesta']
        ]);
        $stm->closeCursor();
        Flight::json(['operation' => $flag]);
    };

    constraintWithoutRole($token, $id_usuario, $execution);
});

Flight::route('PUT /api/actualizar/producto', function () use ($body, $id_usuario, $token, $ip) {
    $execution = function () use ($body, $ip) {
        $query = "CALL up_actualiar_producto(:nombre,:unidad_de_compra,:unidad_de_venta,:categoria,:presentacion,:contenido,:descuento,:precio,:sustancia_activa,:descripcion,:ubicacion,:costo_por_unidad,:codigo_de_barras,:ipv4,:idProducto)";
        $db = Connection::getConnection();
        $stm = $db->prepare($query);
        $isGood = $stm->execute([
            "nombre" => $body["nombre"],
            "unidad_de_compra" => $body["unidad_de_compra"],
            "unidad_de_venta" => $body["unidad_de_venta"],
            "categoria" => $body['categoria'],
            "presentacion" => $body['presentacion'],
            "contenido" => $body['contenido'],
            "descuento" => $body['descuento'],
            "precio" => $body['precio'],
            "sustancia_activa" => $body['sustancia_activa'],
            "descripcion" => $body['descripcion'],
            "ubicacion" => $body['ubicacion'],
            "costo_por_unidad" => $body['costo_por_unidad'],
            "codigo_de_barras" => $body['codigo_de_barras'],
            "ipv4"=>$ip,
            "idProducto"=>$body['idProducto']
        ]);
        Flight::json(["isGood" => $isGood]);
    };
    constraintWithoutRole($token, $id_usuario, $execution);
});

// endregion
$db = null;