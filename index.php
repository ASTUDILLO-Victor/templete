<?php
use Core\Router;
require "vendor/autoload.php";
require "Core/bootstrap.php";
// use Core\Router;
// require 'models/Task.php';

$routes = 
[
    
    'templete' => ['HomeController','show'],
    'tables' => ['PagesController','tables'],
    'tables2' => ['PagesController','tables2'],
    'tables3' => ['PagesController','tables3'],
    'tables4' => ['PagesController','tables4'],
    'registro' => ['PagesController','registro'],
    'crear' => ['TasksController','create'],
    'actualizar' => ['TasksController','toggle'],
    'eliminar' => ['TasksController','delete'],
    'eliminar2' => ['TasksController','delete2'],
    'eliminar3' => ['TasksController','delete3'],
    'eliminar4' => ['TasksController','delete4'],
    'login-form'=>['LoginController','show'] ,
    'login'=>['LoginController','login'] ,
    'logout'=> ['LoginController','logout'],
    'graficos'=> ['PagesController','grafico'],
    'registarlogin'=>['TasksController','registrar'],
    'validar'=>['TasksController','validar'],
    'recuperar'=>['recuperarControllers','show'],
    'recuperar2'=>['recuperarControllers','recuperar'],
    'resta'=>['PagesController','resta'],
    'correo'=>['TasksController','correo'],
    'grafico'=>['PagesController','grafico'],
    'grafico2'=>['PagesController','grafico2'],
    'reporte'=>['PagesController','reporte'],
    'reporte2'=>['PagesController','reporte2'],
    'mychart'=>['mychartController','mychart'],
    'grafico3'=>['PagesController','grafico3'],
    'reporte_uno'=>['PagesController','reporte_uno'],
    'purificadora'=>['PagesController','purificadora'],


    
    



];
$url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = isset($_GET['url']) ? $_GET['url'] : 'login-form';
// $url = trim($_SERVER['REQUEST_URI'], '/');
$router = new Router;
$router->register($routes);
$router->handle($url);



