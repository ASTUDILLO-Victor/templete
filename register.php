<?php
include 'conexion.php';
date_default_timezone_set("America/Guayaquil");

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $descripcion = "Manualmente"; // Descripción fija para las acciones manuales
    $timestamp = date('Y-m-d H:i:s'); // Obtener el timestamp actual

    $sql = "INSERT INTO relay_log (action,timestamp, descripcion) VALUES ('$action','$timestamp' ,'$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

