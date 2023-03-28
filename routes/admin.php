<?php

use ElLlano\Api\middleware\Role;
use ElLlano\Api\middleware\Verify;
use ElLlano\Api\models\Connection;

$db = Connection::getConnection();
$isAjax = Flight::request()->ajax;
$ip = Flight::request()->ip;
$token = (getallheaders())['x-api-key']??false;
$id_usuario = Flight::request()->query['idUsuario']??false;
$body = Flight::request()->data->getData();
$rol_required = "ADMINISTRADOR";

// Revisa si la consulta fue exitosa
function queryResponse($isGood): void
{
    if ($isGood)
    {
        Flight::json(["message" => "Se ha actualizado el registro"], 201);
    } else
    {
        Flight::json(["message" => "No se ha podido actualizar el registro"], 400);
    }
}

// Revisa el token, el usuario y el rol antes de realizar la consulta
function constraint($token, $id_usuario, $rol_required, $callback): void
{
    try {

        if ($token)
        {
            $flag = Verify::token(array('idUsuario'=>$id_usuario,'token'=>$token));
            if ($flag)
            {
                $flag = Role::validate($id_usuario, $rol_required);
                if ($flag){
                    $callback();
                } else
                {
                    Flight::json(["message"=> "El rol de '" . strtolower($rol_required) . "' es requerido"], 403);
                }
            } else {
                Flight::json(['message'=>'Sin autorización'], 401);
            }
        }else {
            Flight::json(['message'=>'No se ha provisto un token'], 403);
        }
    }catch (PDOException|Exception $e){
        Flight::json(['message' => 'Se ha producido un error en el servidor', 'error' => $e->getMessage()], 500);
    }
}


Flight::route('PUT /api/actualizar/producto', function () use ($rol_required, $ip, $body, $db, $id_usuario, $token) {
    $execution = function () use ($db, $body, $ip){
        $query = "CALL up_actualizar_producto(:nombre,:unidad_de_compra,:unidad_de_venta,:categoria,:presentacion,:contenido,:descuento,:precio,:sustancia_activa,:descripcion,:ubicacion,:costo_por_unidad,:codigo_de_barras,:ipv4,:idProducto)";
        $stm = $db->prepare($query);
        $wasGood = $stm->execute([
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
            "codigo_de_barras"=>$body['codigo_de_barras'],
            "ipv4"=>$ip,
            "idProducto"=>$body['id_producto']
        ]);
        queryResponse($wasGood);
    };

    constraint($token,$id_usuario, $rol_required, $execution);
});

Flight::route('DELETE /api/eliminar/producto', function () use ($rol_required, $ip, $body, $db, $id_usuario, $token)
{
    $execution = function () use ($ip, $body, $db)
    {
        $query = "CALL up_eliminar_producto(:idProducto)";
        $stm = $db->prepare($query);
        $wasGood=$stm->execute(['idProducto'=>$body['id_producto']]);
        queryResponse($wasGood);
    };
    constraint($token, $id_usuario, $rol_required, $execution);
});


$db = null;