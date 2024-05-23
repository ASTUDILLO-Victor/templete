<?php
namespace App\controllers;
use Core\Auth;
class LoginController
{
    public function show()
    {
        return view("login");
    }
    public function login()
    {
        Auth::tryLogin($_POST['email'], $_POST['password']);

        if (Auth::check()) {
            return redirect('index.php?url=templete');

        }
        return redirect ('index.php?url=login-form');
    }
    public function logout()
    {
        Auth::logout();
        return redirect("index.php?url=login-form");
    }
}