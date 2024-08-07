<?php
include ('conexion.php');

// Obtener el último registro de la tabla promedio_mq138
$sql = "SELECT estado FROM promedio_mq138 ORDER BY fecha DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el estado del último registro
    $row = $result->fetch_assoc();
    $estado = $row['estado'];
    if ($estado == 'Elevado') {
        $action = 'on';
        $descripcion = 'Concentración elevada de COV';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro de encendido en relay_log
        $sqlInsert = "INSERT INTO relay_log (action,timestamp, descripcion) VALUES ('$action', '$timestamp','$descripcion')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
        // Esperar 10 segundos antes de apagar el relé 2
        sleep(1800);
        // Apagar el relé 2 después de 30 minutos
        $action = 'off';
        $descripcion = 'Apagado automático después de 30 minutos';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro de apagado en relay_log
        $sqlInsert = "INSERT INTO relay_log (action, timestamp, descripcion) VALUES ('$action', '$timestamp' ,'$descripcion')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    } else {
        // Apaga el relé 2
        $action = 'off';
        $descripcion = 'Concentraciones normales de COV';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro en relay_log
        $sqlInsert = "INSERT INTO relay_log (action, timestamp, descripcion) VALUES ('$action', '$timestamp', '$descripcion')";
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
