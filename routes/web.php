<?php

session_start();
$isActive = $_SESSION['active']??false;

Flight::route('GET /',function()
{
    Flight::redirect('/sign-in');
});

Flight::route('GET /dashboard',function() use($isActive)
{
    if ($isActive){
        Flight::render('pages/dashboard/dashboard');
    } else {
        Flight::unauthorized();
    }
});

Flight::route('GET /sign-in',function() use($isActive)
{
    if ($isActive){
        Flight::redirect('/dashboard');
    } else {
        Flight::render('pages/sign-in');
    }
});

Flight::route('GET /sign-up',function() use($isActive)
{
    if ($isActive){
        Flight::redirect('/dashboard');
    } else {
        Flight::render('pages/sign-up');
    }
});

Flight::route('GET /sign-out', function()
{
    if (isset($_SESSION['active'])){
        Flight::clear();

        try{
            $db = \ElLlano\Api\models\Connection::getConnection();
            $stm = $db->prepare('CALL op_delete_token(:idUsuario)');
            $stm->execute(['idUsuario'=>$_SESSION['userID']]);
        } catch (PDOException|Exception $ex) {
            Flight::json(['message' => 'Se ha producido un error en el servidor', 'error'=>$e->getMessage()], 500);
        }
        unset($_SESSION['active']);
        unset($_SESSION['userID']);

        Flight::redirect('/');
    }
});