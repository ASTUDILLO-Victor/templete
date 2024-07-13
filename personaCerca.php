<?php
    include_once "conexion.php";

    if (isset($_GET['cerca'])) {
        $estado = $_GET['cerca'];

        $sql = "UPDATE `estados` SET `personaCerca`='".$estado."';";
        
        if ($conn->query($sql) === TRUE) {
            echo "Registro actualizado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Parámetro 'cerca' no proporcionado";
    }
?>
