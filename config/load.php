<?php
require_once __DIR__ . '/../config/system.php';

require_once ROOT . 'vendor/autoload.php';

require_once ROOT . 'config/dotEnv.php';

require_once ROOT . 'config/databaseInit.php';

require_once ROOT . 'routes/pages.php';

require_once ROOT . 'config/mapFlight.php';

require_once ROOT . 'routes/web.php';

require_once ROOT . 'routes/api/default.php';
//
require_once ROOT . 'routes/api/admin.php';
//
require_once ROOT . 'routes/api/medics.php';
//
require_once ROOT . 'routes/api/allUsers.php';

require_once ROOT . 'test/apiTest.php';

//Flight::route('GET /test2', function (){
//    Flight::json(['message'=>'Este es un mensaje']);
//
//});

Flight::start();