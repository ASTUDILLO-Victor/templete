<?php

use Core\Router;
require "vendor/autoload.php";
require 'core/bootstrap.php';
// use Core\Router;
// require 'models/Task.php';

$routes = 
[
    
    'templete' => ['HomeController','show'],
    //todas las tablas
    'tables' => ['PagesController','tables'],
    'tables2' => ['PagesController','tables2'],
    'tables3' => ['PagesController','tables3'],
    'tables4' => ['PagesController','tables4'],
    // all lo del crud
    'registro' => ['PagesController','registro'],
    'crear' => ['TasksController','create'],
    'actualizar' => ['TasksController','toggle'],
    'eliminar' => ['TasksController','delete'],
    'eliminar2' => ['TasksController','delete2'],
    'eliminar3' => ['TasksController','delete3'],
    'eliminar4' => ['TasksController','delete4'],
    // lo refecente al login 
    'login-form'=>['LoginController','show'] ,
    'login'=>['LoginController','login'] ,
    'logout'=> ['LoginController','logout'],
    //graficos
    'graficos'=> ['PagesController','grafico'],
    //borrar ruta no existe
    'registarlogin'=>['TasksController','registrar'],
    //validar existencia de correo y cedula
    'validar'=>['TasksController','validar'],
    'validar_email'=>['TasksController','validar_correo'],
    //all lo del modulo para recuperar contraseña
    'recuperar'=>['recuperarControllers','show'],
    'recuperar2'=>['recuperarControllers','recuperar'],
    'resta'=>['PagesController','resta'],
    



];
$url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = trim($_SERVER['REQUEST_URI'], '/');
$router = new Router;
$router->register($routes);
$router->handle($url);



