<?php
include_once 'connect.php';

// Archivo de log para depuración
$log_file = 'debug.log';

function log_message($message) {
    global $log_file;
    file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

log_message('Inicio del script');

if (isset($_GET['valor']) ) {
    $val = floatval($_GET['valor']);
    

    log_message("Valores recibidos - VALOR: $valor");

    $stmt = $conn->prepare("INSERT INTO lectura_mq138 (val) VALUES (?)");
    $stmt->bind_param("dd", $val);

    if ($stmt->execute()) {
        echo "GUARDADO";
        log_message('Datos guardados con éxito');
    } else {
        echo "NO GUARDADO";
        log_message('Error al guardar los datos: ' . $stmt->error);
    }

    $stmt->close();
} else {
    echo "Datos no recibidos";
    log_message('Datos no recibidos');
}

$conn->close();
log_message('Fin del script');
?>