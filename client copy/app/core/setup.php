<?php

//require our files, remember should be relative to index.php
require '../app/core/Router.php';
require '../app/models/Model.php';
require '../app/controllers/Controller.php';
require '../app/controllers/MainController.php';
require '../app/controllers/UserController.php';
require '../app/models/User.php';
require '../app/models/Review.php';
require '../app/controllers/ReviewController.php';
require '../app/models/Search.php';
require '../app/controllers/SearchController.php';
require '../app/models/Order.php';
require '../app/controllers/OrderController.php';


//set up env variables
$env = file_exists('../.env') ? parse_ini_file('../.env') : [];

$dbName = getenv('DBNAME') ?: ($env['DBNAME'] ?? null);
$dbHost = getenv('DBHOST') ?: ($env['DBHOST'] ?? null);
$dbUser = getenv('DBUSER') ?: ($env['DBUSER'] ?? null);
$dbPass = getenv('DBPASS') ?: ($env['DBPASS'] ?? null);
$dbPort = getenv('DBPORT') ?: ($env['DBPORT'] ?? 3306);

define('DBNAME', $dbName);
define('DBHOST', $dbHost);
define('DBUSER', $dbUser);
define('DBPASS', $dbPass);
define('DBPORT', $dbPort);

if($_SERVER['SERVER_NAME'] != 'localhost') {
    define('ROOT', 'https://arcane-eyrie-22455-a4ba415920ae.herokuapp.com/');
}
