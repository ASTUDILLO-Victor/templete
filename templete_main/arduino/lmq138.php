<?php
include_once 'connect.php';
date_default_timezone_set("America/Guayaquil");

if (isset($_GET['valor'])) {
    $val = floatval($_GET['valor']);
    $date = date('Y-m-d H:i:s');
    
    $stmt = $conn->prepare("INSERT INTO lectura_mq138 (valor, fecha_hora) VALUES (?, ?)");
    $stmt->bind_param("ds", $val, $date);
    
    if ($stmt->execute()) {
        echo "GUARDADO";
    } else {
        echo "NO GUARDADO";
    }

    $stmt->close();
} else {
    echo "Datos no recibidos";
}

$conn->close();
?>
