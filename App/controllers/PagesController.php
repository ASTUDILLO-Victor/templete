<?php
namespace App\controllers;
use App\models\empleado;
use Core\Auth;
class PagesController
{
    public function tables()
    {
        if (Auth::check()) {
            $user = empleado::all();
            $todo = array_filter($user);
            return view('tables',[
                'tasks' => $user,
                'todo' => $todo,]);
        } else {
            return redirect('index.php?url=login-form');
             // Asegura que el script se detenga después de la redirección
        }
        
        // if (Auth::check()) {
        //     return view('about');
        // } else {
        //     return redirect('index.php?url=login-form');
        //      // Asegura que el script se detenga después de la redirección
        // }

    }
    public function services()
    {
        if (Auth::check()) {
            return view('services');
        } else {
            return redirect('index.php?url=login-form');
             // Asegura que el script se detenga después de la redirección
        }

    }
    public function grafico()
    {
        if (Auth::check()) {
            return view('grafico');
        } else {
            return redirect('index.php?url=login-form');
             // Asegura que el script se detenga después de la redirección
        }

    }
}

