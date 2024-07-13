<?php
    include_once "conexion.php";

    if (isset($_GET['estado'])) {
        $estado = $_GET['estado'];

        $sql = "UPDATE `estados` SET `estadoAlarma`='".$estado."';";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Parámetro 'cerca' no proporcionado";
    }
?>
