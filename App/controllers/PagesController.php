<?php
namespace App\controllers;
use Core\Auth;
class PagesController
{
    public function tables()
    {
        return view('tables');
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
    public function contact()
    {
        if (Auth::check()) {
            return view('contact');
        } else {
            return redirect('index.php?url=login-form');
             // Asegura que el script se detenga después de la redirección
        }

    }
}

