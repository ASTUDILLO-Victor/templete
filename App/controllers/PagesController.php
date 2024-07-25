<?php
namespace App\controllers;
use App\models\empleado;
use Core\Auth;
class PagesController
{
    public function tables()
    {
        if (Auth::check()) {
            $userRole = $_SESSION['id_rol'] ?? null; // Verifica el rol del usuario desde la sesión
    
            if ( $userRole === 1 ) {
                $user = empleado::all();
                $todo = array_filter($user);
                $user1 = empleado::all5();
                $todo1 = array_filter($user1);
                return view('tables', [
                    'tasks' => $user,
                    'todo' => $todo,
                    'tasks1' => $user1,
                    'todo1' => $todo1,

                ]);
            } else {
                return redirect('index.php?url=templete'); // Redirige a la página principal si no es Admin
            }
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
        
    }
    public function tables2()
    {
        if (Auth::check()) {
            $userRole = $_SESSION['id_rol'] ?? null; // Verifica el rol del usuario desde la sesión
    
            if ($userRole === 1 ) {
                $user = empleado::all2();
                $todo = array_filter($user);
                return view('tables2', [
                    'tasks' => $user,
                    'todo' => $todo,
                    
                ]);
            } else {
                return redirect('index.php?url=templete'); // Redirige a la página principal si no es Admin
            }
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
    }
    public function tables3()
    {
        if (Auth::check()) {
            $userRole = $_SESSION['id_rol'] ?? null; // Verifica el rol del usuario desde la sesión
    
            if ($userRole === 2 ) {
                $user = empleado::all3();
                $todo = array_filter($user);
                $user1 = empleado::all6();
                $todo1 = array_filter($user1);
                return view('tables3', [
                    'tasks' => $user,
                    'todo' => $todo,
                    'tasks1' => $user1,
                    'todo1' => $todo1,
                ]);
            } else {
                return redirect('index.php?url=templete'); // Redirige a la página principal si no es Admin
            }
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
    }
    public function tables4()
    {
        if (Auth::check()) {
            $userRole = $_SESSION['id_rol'] ?? null; // Verifica el rol del usuario desde la sesión
    
            if ($userRole === 2 ) {
                $user = empleado::all4();
                $todo = array_filter($user);
                return view('tables4', [
                    'tasks' => $user,
                    'todo' => $todo,
                ]);
            } else {
                return redirect('index.php?url=templete'); // Redirige a la página principal si no es Admin
            }
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
    }
    public function registro()
    {
        if (Auth::check()) {
            $userRole = $_SESSION['id_rol'] ?? null; // Verifica el rol del usuario desde la sesión
            if ($userRole === 1 ) {
                $user = empleado::all5();
            $todo = array_filter($user);
            return view('registro',[
                'tasks' => $user,
                'todo' => $todo,
            ]);
            } elseif($userRole === 2) {
                $user = empleado::all6();
                $todo = array_filter($user);
                return view('registro',[
                    'tasks' => $user,
                    'todo' => $todo,
                ]);; // Redirige a la página principal si no es Admin
            }
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
        // if (Auth::check()) {
        //     $user = empleado::all5();
        //     $todo = array_filter($user);

        //     return view('registro',[
        //         'tasks' => $user,
        //         'todo' => $todo,
        //     ]);
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
    public function resta()
    {
            return view('resta');

    }
    public function grafico()
    {
        if (Auth::check()) {
                return view('grafico');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
    }
    public function grafico2()
    {
        if (Auth::check()) {
                return view('grafico2');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }  
    }
    public function grafico3()
    {
        if (Auth::check()) {
                return view('grafico3');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }  
    }
    public function reporte()
    {
        if (Auth::check()) {
            return view('reporte');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
    }
    public function reporte2()
    {
        if (Auth::check()) {
            return view('reporte2');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
        
    }
    public function reporte_uno()
    {
        if (Auth::check()) {
            return view('reporte_uno');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
        
    }
    public function purificadora()
    {
        if (Auth::check()) {
            return view('purificadora');
        } else {
            return redirect('index.php?url=login-form'); // Redirige a la página de inicio de sesión si no está autenticado
        }
        
    }
}

