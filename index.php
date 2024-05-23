<?php

use Core\Router;
require "vendor/autoload.php";
require 'core/bootstrap.php';
// use Core\Router;
// require 'models/Task.php';

$routes = 
[
    
    'templete' => ['HomeController','show'],
    'tables' => ['PagesController','tables'],
    'services' => ['PagesController','services'],
    'contact' => ['PagesController','contact'],
    'crear' => ['TasksController','create'],
    'actualizar' => ['TasksController','toggle'],
    'eliminar' => ['TasksController','delete'],
    'login-form'=>['LoginController','show'] ,
    'login'=>['LoginController','login'] ,
    'logout'=> ['LoginController','logout'],
];
$url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = trim($_SERVER['REQUEST_URI'], '/');
$router = new Router;
$router->register($routes);
$router->handle($url);



