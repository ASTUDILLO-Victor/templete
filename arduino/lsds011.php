<?php
include_once 'connect.php';

date_default_timezone_set("America/Guayaquil");
// Archivo de log para depuración
$log_file = 'debug.log';

function log_message($message) {
    global $log_file;
    file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

log_message('Inicio del script');

if (isset($_GET['pm10']) && isset($_GET['pm25'])) {
    $pm10 = floatval($_GET['pm10']);
    $pm25 = floatval($_GET['pm25']);

    log_message("Valores recibidos - PM10: $pm10, PM25: $pm25");

    $stmt = $conn->prepare("INSERT INTO lectura_sds011 (pm10, pm25) VALUES (?, ?)");
    $stmt->bind_param("dd", $pm10, $pm25);

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
