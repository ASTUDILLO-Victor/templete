<?php
include ('conexion.php');

// Obtener el último registro de la tabla promedio_mq138
$sql = "SELECT estado FROM promedio_mq138 ORDER BY fecha DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el estado del último registro
    $row = $result->fetch_assoc();
    $estado = $row['estado'];
    $timestamp = date('Y-m-d H:i:s');
    if ($estado == 'Elevado') {
        $action = 'off';
        $descripcion = 'Apagado automaticamente despues de 30 minutos';
        // Insertar el registro de encendido en relay_log
        $sqlInsert = "INSERT INTO relay_log (action, timestamp, descripcion) VALUES ('$action','$timestamp', '$descripcion')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
} else {
    echo "No records found.<br>";
}
$conn->close();
?>
