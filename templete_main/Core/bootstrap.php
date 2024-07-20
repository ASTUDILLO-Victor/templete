<?php
require_once 'app.php';
require_once 'Database/QueryBuilder.php';
require_once 'Database/connection.php';
use Core\App;
use Core\Database\QueryBuilder;
use Core\Database\Connection;
App::set("config",require 'config.php');

App:: set ('database' , new QueryBuilder(
    Connection::start(App::get('config')['database'])
));

if (App::get('config')['error_handling']) {
    //mostrar errores en el navegador 
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
}


