<?php
namespace App\controllers;

use App\models\empleado;
use App\models\Task;

class TasksController
{
    public function create()
    {
        if (empty($_POST['Ecedu']) || empty($_POST['Enom']) || empty($_POST['Email']) || empty($_POST['pas']) || empty($_POST['Epo']) || empty($_POST['Eofi']) || empty($_POST['Edire'])) {
            // Al menos un campo está vacío, mostrar un mensaje y redirigir de vuelta al formulario
            $mensaje = "Todos los campos son obligatorios. Por favor, llene todos los campos.";
            header("Location: formulario.php?tables&mensaje=" . urlencode($mensaje));
            exit();
        }
        // Establecer la conexión con la base de datos (reemplaza los valores según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "todos";

        $conn = new \mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para verificar si la cédula ya está registrada
        $sql_check_cedula = "SELECT COUNT(*) AS total FROM empleado WHERE cedula = ?";
        $stmt_check_cedula = $conn->prepare($sql_check_cedula);
        $stmt_check_cedula->bind_param("s", $_POST['Ecedu']);
        $stmt_check_cedula->execute();
        $result_check_cedula = $stmt_check_cedula->get_result();
        $row_check_cedula = $result_check_cedula->fetch_assoc();

        // Verificar si la cédula ya está registrada
        if ($row_check_cedula['total'] > 0) {
            // Cédula ya registrada, mostrar mensaje y redirigir a la página de tablas
            $mensaje = "Cédula ya registrada.";
            $stmt_check_cedula->close();
            $conn->close();
            header("Location: index.php?url=tables&mensaje=" . urlencode($mensaje)); // Redirección después de 3 segundos
            exit();
        }

        // Preparar la consulta SQL con parámetros
        $sql = "INSERT INTO empleado (cedula, name, email, password, posición, oficina, direcion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("sssssssi", $_POST['Ecedu'], $_POST['Enom'], $_POST['Email'], $_POST['pas'], $_POST['Epo'], $_POST['Eofi'], $_POST['Edire'], $estado);

        // Valor predeterminado para el estado
        $estado = 1;

        // Ejecutar la declaración
        $stmt->execute();

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
        

        // Redirigir después del insert
        header("Location: index.php?url=tables&success=1");

        exit();
    }
    public function toggle()
    {
        if (!isset($_POST['id'], $_POST['Ecedu'], $_POST['Enom'], $_POST['Email'], $_POST['Epo'], $_POST['Eofi'], $_POST['Edire'])) {
            die('Error: Missing parameters.');
        }

        $task = empleado::find($_POST['id']);
        $task->update([

            'cedula' => $_POST['Ecedu'],
            'name' => $_POST['Enom'],
            'email' => $_POST['Email'],
            'posición' => $_POST['Epo'],
            'oficina' => $_POST['Eofi'],
            'direcion' => $_POST['Edire'],
            'estado' => 1,
        ]);
        return redirect('index.php?url=tables');
    }
    public function delete()
    {
        $task = empleado::find($_POST['id']);
        $task->delete();
        return redirect('index.php?url=tables');

    }
}