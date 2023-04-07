<?php

use ElLlano\Api\models\Connection;

$token = (getallheaders())['x-api-key'] ?? false;
$id_usuario = Flight::request()->query['idUsuario'] ?? false;
$body = Flight::request()->data->getData();
$ip = Flight::request()->ip;

Flight::route('POST /api/venta/productos', function () use($token, $id_usuario, $body)
{
    $execution = function() use($body)
    {
        $query = "CALL op_realizar_venta(:idProducto, :cantidad, :folio, :)";
    };
});




$db = null;
