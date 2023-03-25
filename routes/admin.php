<?php

$db = \ElLlano\Api\models\Connection::getConnection();

Flight::route('UPDATE /api/update/user/@role/@idUser', function (){

});

$db = null;