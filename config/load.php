<?php
require_once __DIR__ . '/../config/system.php';

require_once ROOT . 'vendor/autoload.php';

require_once ROOT . 'config/dotEnv.php';

require_once ROOT . 'routes/admin.php';

require_once ROOT . 'routes/default.php';

require_once ROOT . 'routes/medics.php';

require_once ROOT . 'routes/allUsers.php';

require_once ROOT . 'test/apiTest.php';

//Flight::route('GET /test2', function (){
//    Flight::json(['message'=>'Este es un mensaje']);
//
//});

Flight::start();
