<?php
function dd($value)
{
    return die(var_dump($value));
}
function view($path,$params=[]){
    extract($params);
    require "view/{$path}.php";
}
function redirect($path){
    header("location:{$path}");
}
