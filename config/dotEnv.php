<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


// Constants to the Data Base. Modify to make connections in your pc database
define("DBNAME", $_ENV['DBNAME']);
define("DBPASS", $_ENV['DBPASSWORD']);
define("DBUSER", $_ENV['DBUSER']);
define("DBHOST", $_ENV['DBHOST']);
define("DBPORT", $_ENV['DBPORT']);

// Constant to ENCRYPTION token key
define("ENCRYPTIONKEY", $_ENV['ENCRYPTIONKEY']);