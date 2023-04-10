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
        Flight::render('pages/menus/index', null, 'content');
        // Flight::render('pages/menus/general/dashboard', null, 'content');
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
    $name_link = 'producto';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'productos',
            'headers' => array(
                '#', 
                'Nombre',
                'Sustancia activa',
                'Costo',
                'Costo por unidad',
                'Presentación',
                'Categoría',
                'Unidad de venta',
                'Unidad de compra',
                'Contenido',
                'Descuento',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/ProductsForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Productos registrados',
            'parent' => 'Categorias',
            'child' => 'Productos',
            'text_button' => $name_link
        ), 
        'header_nav'
    ); 
    Flight::render('pages/menus/general/categories/products');
});
Flight::route('GET /dashboard/views/catalogo/proveedores', function()
{
    $name_link = 'proveedores';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'proveedores',
            'headers' => array(
                '#', 
                'Nombre',
                'Correo',
                'Teléfono',
                'RFC',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/providersForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Proveedores registrados',
            'parent' => 'Categorias',
            'child' => 'Proveedores',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/categories/providers');
});

Flight::route('GET /dashboard/views/catalogo/unidad-de-venta', function()
{
    $name_link = 'unidad de venta';
    $name_id = 'unidad-de-venta';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'Unidades de venta',
            'headers' => array(
                '#', 
                'Unidad',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/sellUniteForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_id,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Unidades de venta',
            'parent' => 'Categorias',
            'child' => 'Unidad de venta',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/categories/sell-unite');
});

Flight::route('GET /dashboard/views/catalogo/unidad-de-compra', function()
{
    $name_link = 'Unidad de compra';
    $name_id = 'Unidad-de-compra';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'unidad de compra',
            'headers' => array(
                '#', 
                'Unidad',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/buyUniteForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_id,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Unidades de compra',
            'parent' => 'Categorias',
            'child' => 'Unidades de compra',
            'text_button' => $name_link
        ), 
        'header_nav');
    Flight::render('pages/menus/general/categories/buy-unite');
});

Flight::route('GET /dashboard/views/catalogo/categorias', function()
{
    $name_link = 'categoria';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'categorias',
            'headers' => array(
                '#', 
                'Categoría',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/categoriesForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Categorias',
            'parent' => 'Categorias',
            'child' => 'Categorias',
            'subtitle' => 'Categoria a la que pertenece un producto',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/categories/categories');
});
Flight::route('GET /dashboard/views/catalogo/almacenes', function()
{
    $name_link = 'almacen';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'almacenes',
            'headers' => array(
                '#', 
                'Almacen',
                'Descripción',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/storeForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Almacenes registrados',
            'parent' => 'Categorias',
            'child' => 'Almacenes',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/categories/stores');
});
#endregion
#region compras dropdown
Flight::route('GET /dashboard/views/catalogo/ordenes-de-compra', function()
{
    $name_link = 'orden de compra';
    $name_id = 'orden-de-compra';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'ordenes de compra',
            'headers' => array(
                '#', 
                'Fecha de compra',
                'Fecha de entrega',
                'Método de pago',
                'Proveedor',
                'Realizó la compra',
                'Estatus de entrega',
                'Estatus de pago',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/boughtOrdersForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_id,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Ordenes de compra',
            'parent' => 'Compras',
            'child' => 'ordenes de pago',
            'subtitle' => 'Ordenes de compra realizadas a los proveedores registrados',
            'text_button' => $name_link
        ), 
        'header_nav');
    Flight::render('pages/menus/general/boughts/bought-orders');
});
Flight::route('GET /dashboard/views/catalogo/pagos', function()
{
    $name_link = 'pago';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'pagos',
            'headers' => array(
                '#', 
                'Cantidad',
                'Método de pago',
                'Orden de compra',
                'Cantidad',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/paysForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Pagos realizados',
            'parent' => 'Compras',
            'child' => 'pagos',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/boughts/pays');
});
#endregion
#region adminstracion dropdown
Flight::route('GET /dashboard/views/catalogo/entradas', function()
{
    $name_link = 'entrada';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'entradas',
            'headers' => array(
                '#', 
                'Nombre de lote',
                'Cantidad',
                'Caducidad',
                'Fecha de compra',
                'Fabricación',
                'Costo por unidad',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/entriesForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Entradas de producto',
            'parent' => 'Administración',
            'child' => 'Entradas',
            'text_button' => $name_link
        ), 
        'header_nav');
    Flight::render('pages/menus/general/administration/entries');
});
Flight::route('GET /dashboard/views/catalogo/traspaso', function()
{
    $name_link = 'traspaso';
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
        'pages/partials/forms/transportsForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Traslados entre almacenes',
            'parent' => 'Administración',
            'child' => 'traslados',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/administration/transports');
});
Flight::route('GET /dashboard/views/catalogo/salidas', function()
{
    $name_link = 'salida';
    Flight::render(
        'pages/partials/Table',
        array(
            'dataName' => 'consumos',
            'headers' => array(
                'Folio', 
                'Paciente',
                'Fecha de consumo',
                'Realizó la salida',
                'Opciones'
                )
        ),
        'table'
    );
    Flight::render(
        'pages/partials/forms/outputsForm',
        null,
        'modal_body'
    );
    Flight::render(
        'pages/partials/ModalForm',
        array(
            'id_modal' => $name_link,
            'modal_title' => 'Registrar ' . $name_link
        ),
        'modal_form'
    );
    Flight::render(
        'pages/partials/HeaderNav', 
        array(
            'title' => 'Consumos del hospital',
            'parent' => 'Administración',
            'child' => 'Consumos',
            'text_button' => $name_link
        ), 
        'header_nav'
    );
    Flight::render('pages/menus/general/administration/outputs');
});
#endregion


#endregion