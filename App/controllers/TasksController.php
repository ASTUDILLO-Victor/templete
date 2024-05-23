<?php
namespace App\controllers;
use App\models\empleado;
use App\models\Task;
class TasksController
{
    public function create()
    {
        empleado::create([
            'title' => $_POST['title'],
            'completed' => 0,
            'color' => $_POST['color'],
        ]);
        return redirect('index.php?url=home');

    }
    public function toggle()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "todos";
        
        // Crear conexión
        $conn = new \mysqli($servername, $username, $password, $dbname);
        
        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        
        // ID del usuario que deseas actualizar
        
        // Nuevos valores
        $id = $_POST['id'];
        $cedula = $_POST['Ecedu'];
        $name = $_POST['Enom'];
        $email = $_POST['Email'];
        $posición = $_POST['Epo'];
        $oficina = $_POST['Eofi'];
        $direcion = $_POST['Edire'];
        
        // Sentencia SQL para actualizar
        $sql = "UPDATE empleado SET cedula ='$cedula',name ='$name', email='$email',posición='$posición',oficina='$oficina',direcion='$direcion' WHERE id_e=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Usuario actualizado correctamente";
            return redirect('index.php?url=tables');
        } else {
            echo "Error al actualizar usuario: " . $conn->error;
        }
        
        // Cerrar conexión
        $conn->close();
    }
    public function delete()
    {
        $task = empleado::find($_POST['id']);
        $task->delete();
        return redirect('index.php?url=tables');

    }
}