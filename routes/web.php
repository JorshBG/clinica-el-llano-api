<?php

use ElLlano\Api\models\Connection;

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
            $db = Connection::getConnection();
            $stm = $db->prepare('CALL op_delete_token(:idUsuario)');
            $stm->execute(['idUsuario'=>$_SESSION['userID']]);
        } catch (PDOException|Exception $ex) {
            Flight::json(['message' => 'Se ha producido un error en el servidor', 'error'=>$ex->getMessage()], 500);
        }
        session_unset();
        session_destroy();
        Flight::redirect('/');
    }
});

#region Admin views on dashboard

Flight::route('GET /dashboard/view/dashboard', function()
{
    Flight::render('pages/menus/admin/dashboard');
});

#endregion

#region admin pages
#region dashboard menu
Flight::route('GET /dashboard/view/index', function()
{
    Flight::render('pages/menus/general/dashboard');
});
#endregion
#region categorias dropdown
Flight::route('GET /dashboard/views/catalogo/productos', function()
{
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'productos',
            'headers' => array(
                '#', 
                'Nombre',
                'Cantidad',
                'Costo',
                'Costo por unidad',
                'Presentación',
                'Categoría',
                'Unidad de venta',
                'Unidad de compra',
                'Contenido',
                'Descuento'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Productos registrados',
            'parent' => 'Categorias',
            'child' => 'Productos'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/products');
});
Flight::route('GET /dashboard/views/catalogo/proveedores', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Proveedores registrados',
            'parent' => 'Categorias',
            'child' => 'Proveedores'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/providers');
});
Flight::route('GET /dashboard/views/catalogo/unidad-de-medida', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Unidades de medida',
            'parent' => 'Categorias',
            'child' => 'Unidades de medida',
            'subtitle' => 'Unidades de medida sobre los productos registrados'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/measure-unite');
});
Flight::route('GET /dashboard/views/catalogo/categorias', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Categorias',
            'parent' => 'Categorias',
            'child' => 'Categorias',
            'subtitle' => 'Categoria a la que pertenece un producto'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/categories');
});
Flight::route('GET /dashboard/views/catalogo/almacenes', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Almacenes registrados',
            'parent' => 'Categorias',
            'child' => 'Almacenes'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/stores');
});
#endregion
#region compras dropdown
Flight::route('GET /dashboard/views/catalogo/ordenes-de-pago', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Ordenes de compra',
            'parent' => 'Compras',
            'child' => 'ordenes de pago',
            'subtitle' => 'Ordenes de compra realizadas a los proveedores registrados'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/boughts/pay-orders');
});
Flight::route('GET /dashboard/views/catalogo/pagos', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Pagos realizados',
            'parent' => 'Compras',
            'child' => 'pagos'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/boughts/pays');
});
#endregion
#region adminstracion dropdown
Flight::route('GET /dashboard/views/catalogo/entradas', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Entradas de producto',
            'parent' => 'Administración',
            'child' => 'Entradas'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/administration/entries');
});
Flight::route('GET /dashboard/views/catalogo/traspaso', function()
{
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'traslados',
            'headers' => array(
                '#', 
                'Almacen de origen',
                'Almacen de destino',
                'Fecha de petición',
                'Fecha de cierre',
                'Total de productos',
                'Estatus',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Traslados entre almacenes',
            'parent' => 'Administración',
            'child' => 'traslados'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/administration/transports');
});
Flight::route('GET /dashboard/views/catalogo/salidas', function()
{
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Consumos del hospital',
            'parent' => 'Administración',
            'child' => 'Consumos'
        ), 
        'header_nav');
    Flight::render('pages/menus/general/administration/outputs');
});
#endregion


#endregion