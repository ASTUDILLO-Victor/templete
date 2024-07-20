<?php
    include_once "conexion.php";
    date_default_timezone_set('America/Guayaquil');


    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];
        $date = date('Y-m-d H:i:s');
        $tipo = $estado == '1' ? "Salida" : "Entrada";

        $sql = "INSERT INTO `tablets`(`fecha`) VALUES ('".$date."')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Parámetro 'cerca' no proporcionado";
    }
?>
