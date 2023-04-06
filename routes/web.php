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
        // Renderizar Menu bar views/pages/partials/MenuBar.php
//        views/pages/partials/SideMenusAdmin.php
        Flight::render('pages/partials/MenuBar', null, 'menuBar');
        Flight::render('pages/partials/NavBar', null, 'navBar');
        switch ($_SESSION['userAlmacen']){
            case 'GENERAL':
                Flight::render('pages/partials/SideMenusAdmin', null, 'menus');
                break;
            case 'HOSPITAL':
                Flight::render('pages/partials/SideMenusMedics', null, 'menus');
                break;
            case 'FARMACIA':
                Flight::render('pages/partials/SideMenusEmployee', null, 'menus');
                break;
            default:
                break;
        }
        Flight::render('pages/partials/SideBar', null, 'sideBar');
        Flight::render('pages/menus/general/dashboard', null, 'content');
        Flight::render('index');
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
        unset($_SESSION['userRole']);

        Flight::redirect('/');
    }
});

// region Admin views on dashboard

Flight::route('GET /dashboard/view/dashboard', function()
{
    Flight::render('pages/menus/admin/dashboard');
});

// endregion