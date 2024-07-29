<?php
include ('conexion.php');

// Obtener el último registro de la tabla promedio_sds011
$sql = "SELECT estado FROM promedio_sds011 ORDER BY fecha DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el estado del último registro
    $row = $result->fetch_assoc();
    $estado = $row['estado'];
    // Verificar el estado y controlar el relé
    if ($estado == 'Elevado') {
        // Enciende el relé
        $action = 'on';
        $descripcion = 'Concentración elevada de Pm10 o Pm2.5';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro de encendido en relay_log
        $sqlInsert = "INSERT INTO relay_log (action,timestamp, descripcion) VALUES ('$action', '$timestamp','$descripcion')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }

        // Esperar 10 segundos antes de apagar el relé
        sleep(1800);

        // Apagar el relé después de 30 minutos
        $action = 'off';
        $descripcion = 'Apagado automático después de 30 minutos';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro de apagado en relay_log
        $sqlInsert = "INSERT INTO relay_log (action, timestamp,descripcion) VALUES ('$action', '$timestamp','$descripcion')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Record inserted successfully<br>";

        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    } else {
        // Apaga el relé
        $action = 'off';
        $descripcion = 'Concentraciones normales de PM10 y PM2.5';
        $timestamp = date('Y-m-d H:i:s');
        // Insertar el registro en relay_log
        $sqlInsert = "INSERT INTO relay_log (action,timestamp, descripcion) VALUES ('$action', '$timestamp','$descripcion')";
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
