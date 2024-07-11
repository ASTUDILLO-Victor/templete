<?php
// Usar las clases después de cargarlas automáticamente
use Core\App;
use Core\Database\QueryBuilder;
use Core\Database\Connection;

// Verificar que la clase App esté cargada correctamente
if (!class_exists('Core\App')) {
    die('Class Core\App not found!');
}

App::set("config", require 'config.php');

App::set('database', new QueryBuilder(
    Connection::start(App::get('config')['database'])
));

if (App::get('config')['error_handling']) {
    // Mostrar errores en el navegador 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
