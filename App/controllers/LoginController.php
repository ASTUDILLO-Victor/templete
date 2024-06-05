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
        // Sanitizar y validar las entradas del usuario
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // Asumiendo que el password se maneja de manera segura más adelante
    
        // Intentar login usando métodos seguros en la clase Auth
        if (Auth::tryLogin($email, $password)) {
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
