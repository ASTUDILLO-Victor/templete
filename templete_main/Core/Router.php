<?php
namespace Core;

class Router
{
    protected $routes = [];

    public function  register($routes){
        $this->routes = $routes;
    }

    public function handle($url)
    {
        if(array_key_exists($url, $this->routes)){
            $controller= $this->routes[$url][0];
            $method= $this->routes[$url][1];
            $controller="App\\controllers\\{$controller}";
            if(!class_exists($controller)){
                throw new \Exception("error processing request");
            }
            if(!method_exists($controller, $method)){
                throw new \Exception("el metodo no existe en la clase y nombre de la clase");
            }

            return (new $controller)->$method();
            
        }
        die("ruta no existe.");
        
    }
}

