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
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.'
                        }).then(function() {
                            window.location = 'index.php?url=login-form';
                        });
                    });
                 </script>";
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect("index.php?url=login-form");
    }
    
}
