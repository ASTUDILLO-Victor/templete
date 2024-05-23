<?php
namespace App\controllers;
use Core\Auth;
use App\models\Task;

class HomeController
{
    public function show()
    {
        if (Auth::check()) {
            return view('index');
        } else {
            return redirect('index.php?url=login-form');
             // Asegura que el script se detenga después de la redirección
        }
        
        
    }
}