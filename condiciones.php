<?php
include ('conexion.php');

// Obtener el último registro de la tabla promedio_mq138
$sql_mq138 = "SELECT estado FROM promedio_mq138 ORDER BY fecha DESC LIMIT 1";
$result_mq138 = $conn->query($sql_mq138);
$estado_mq138 = $result_mq138->num_rows > 0 ? $result_mq138->fetch_assoc()['estado'] : '';

// Obtener el último registro de la tabla promedio_sds011
$sql_sds011 = "SELECT estado FROM promedio_sds011 ORDER BY fecha DESC LIMIT 1";
$result_sds011 = $conn->query($sql_sds011);
$estado_sds011 = $result_sds011->num_rows > 0 ? $result_sds011->fetch_assoc()['estado'] : '';

// Verificar los estados y definir la acción y descripción correspondientes
if ($estado_mq138 == 'Elevado' && $estado_sds011 == 'Elevado') {
    $action = 'on';
    $descripcion = 'Concentraciones Elevadas';
} elseif ($estado_mq138 == 'Elevado') {
    $action = 'on';
    $descripcion = 'Concentración elevada de COV';
} elseif ($estado_sds011 == 'Elevado') {
    $action = 'on';
    $descripcion = 'Concentración elevada de PM10 o PM2.5';
} else {
    $action = 'off';
    $descripcion = 'Concentraciones normales';
}

// Registrar la acción en relay_log
$timestamp = date('Y-m-d H:i:s');
$sqlInsert = "INSERT INTO relay_log (action, timestamp, descripcion) VALUES ('$action', '$timestamp', '$descripcion')";
if ($conn->query($sqlInsert) === TRUE) {
    echo "Record inserted successfully<br>";
} else {
    echo "Error inserting record: " . $conn->error . "<br>";
}

// Si la acción es 'on', esperar 30 minutos y luego apagar el relé
if ($action == 'on') {
    sleep(1800);
    $action = 'off';
    $descripcion = 'Apagado automático después de 30 minutos';
    $timestamp = date('Y-m-d H:i:s');
    $sqlInsert = "INSERT INTO relay_log (action, timestamp, descripcion) VALUES ('$action', '$timestamp', '$descripcion')";
    if ($conn->query($sqlInsert) === TRUE) {
        echo "Record inserted successfully<br>";
    } else {
        echo "Error inserting record: " . $conn->error . "<br>";
    }
}

$conn->close();
?>
