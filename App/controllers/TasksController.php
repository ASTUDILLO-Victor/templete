<?php
namespace App\controllers;

use App\models\empleado;
use App\models\Task;

class TasksController
{
    public function create()
    {
        // todo el create cambio ya pude hacer que me funcione el codigo del querybilder
        // Validación y saneamiento de datos
        $cedula = filter_input(INPUT_POST, 'Ecedu', FILTER_SANITIZE_STRING);
        $name = filter_input(INPUT_POST, 'Enom', FILTER_SANITIZE_STRING);
        $ape = filter_input(INPUT_POST, 'Eape', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
        $password = password_hash(filter_input(INPUT_POST, 'pas', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
        $id_rol = filter_input(INPUT_POST, 'Epo', FILTER_SANITIZE_NUMBER_INT);
        $sexo = filter_input(INPUT_POST, 'Ese', FILTER_SANITIZE_STRING);
        $celu = filter_input(INPUT_POST, 'Ecelu', FILTER_SANITIZE_STRING);
        $fecha = filter_input(INPUT_POST, 'Efe', FILTER_SANITIZE_STRING);
        $dire = filter_input(INPUT_POST, 'Edire', FILTER_SANITIZE_STRING);
        $tabla = filter_input(INPUT_POST, 'tabla', FILTER_SANITIZE_STRING);
    
        // Comprobación de campos obligatorios
        if (!$cedula || !$name || !$ape || !$email || !$password || !$id_rol || !$sexo || !$celu || !$fecha || !$dire) {
            header("Location: index.php?url=form&&error=missing_fields");
            exit();
        }
    
        try {
            // Crear nuevo empleado
            empleado::create([
                'cedula' => $cedula,
                'name' => $name,
                'ape' => $ape,
                'email' => $email,
                'password' => $password,
                'id_rol' => $id_rol,
                'sexo' => $sexo,
                'celu' => $celu,
                'fecha' => $fecha,
                'dire' => $dire,
            ]);
        } catch (\Exception $e) {
            header("Location: index.php?url=form&&error=database_error");
            exit();
        }
    
        // Redireccionar según la tabla
        $location = ($tabla == "tables") ? "index.php?url=tables&&success=1" : "index.php?url=tables3&&success1=1";
        header("Location: $location");
        exit();
    }

    public function toggle()
    {
        // Verificar si todos los parámetros están presentes
    $requiredParams = ['id', 'Ecedu', 'Enom', 'Eape', 'Email', 'Epo', 'Ese', 'Ecelu', 'Efe', 'Edire', 'tabla'];
    foreach ($requiredParams as $param) {
        if (!isset($_POST[$param])) {
            die('Error: Missing parameters.');
        }
    }

    // Sanitizar y validar entradas
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $cedula = filter_input(INPUT_POST, 'Ecedu', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'Enom', FILTER_SANITIZE_STRING);
    $ape = filter_input(INPUT_POST, 'Eape', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
    $id_rol = filter_input(INPUT_POST, 'Epo', FILTER_VALIDATE_INT);
    $sexo = filter_input(INPUT_POST, 'Ese', FILTER_SANITIZE_STRING);
    $celu = filter_input(INPUT_POST, 'Ecelu', FILTER_SANITIZE_STRING);
    $fecha = filter_input(INPUT_POST, 'Efe', FILTER_SANITIZE_STRING);
    $dire = filter_input(INPUT_POST, 'Edire', FILTER_SANITIZE_STRING);
    $tabla = filter_input(INPUT_POST, 'tabla', FILTER_SANITIZE_STRING);

    if ($id === false || $email === false || $id_rol === false) {
        die('Error: Invalid parameters.');
    }

    try {
        // Buscar la tarea
        $task = empleado::find($id);
        if (!$task) {
            die('Error: Task not found.');
        }

        // Actualizar la tarea con datos validados y saneados
        $task->update([
            'cedula' => $cedula,
            'name' => $name,
            'ape' => $ape,
            'email' => $email,
            'id_rol' => $id_rol,
            'estado' => 1,
            'sexo' => $sexo,
            'celu' => $celu,
            'fecha' => $fecha,
            'dire' => $dire,
        ]);

        // Redireccionar según el valor de 'tabla'
        if ($tabla === "tables") {
            header("Location: index.php?url=tables&success=1");
            exit();
        } elseif ($tabla === "tables3") {
            header("Location: index.php?url=tables3&success1=1");
            exit();
        } else {
            die('Error: Invalid table parameter.');
        }
    } catch (\Exception $e) {
        // Manejo de excepciones
        die('Error: ' . $e->getMessage());
    }
    }

    public function delete1($id, $tableSuffix)
{
    // Validar el ID para asegurarse de que es un número entero
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        // Manejar el error de validación aquí, por ejemplo, redirigir con un mensaje de error
        return redirect('index.php?url=error');
    }

    // Buscar el registro
    $task = empleado::find($id);

    if ($task) {
        // Llamar al método de eliminación dinámicamente
        $deleteMethod = 'delete' . $tableSuffix;
        if (method_exists($task, $deleteMethod)) {
            $task->$deleteMethod();
        } else {
            // Manejar el error de método no encontrado
            return redirect('index.php?url=error');
        }
    } else {
        // Manejar el caso en que no se encuentre el registro
        return redirect('index.php?url=error');
    }

    // Redirigir a la URL correspondiente
    return redirect("index.php?url=tables" . $tableSuffix);
}

// Métodos específicos de eliminación que llaman al método genérico
public function delete()
{
    return $this->delete1($_POST['id'], '');
}

public function delete2()
{
    return $this->delete1($_POST['id'], '2');
}

public function delete3()
{
    return $this->delete1($_POST['id'], '3');
}

public function delete4()
{
    return $this->delete1($_POST['id'], '4');
}
    //validar cedula 
    public function validar()
    {
        empleado::select([
            'cedula' => $_REQUEST['cedula'],    
        ]);
    }
}
