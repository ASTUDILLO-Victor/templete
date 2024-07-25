<?php
include 'conexion.php';

// Obtener el último registro de promedio_sds011
$sql_sds011 = "SELECT fecha, promedio_pm10, promedio_pm25 FROM promedio_sds011 ORDER BY fecha DESC LIMIT 1";
$result_sds011 = $conn->query($sql_sds011);
$data_sds011 = $result_sds011->fetch_assoc();

// Obtener el último registro de promedio_mq138
$sql_mq138 = "SELECT fecha, promedio_valor FROM promedio_mq138 ORDER BY fecha DESC LIMIT 1";
$result_mq138 = $conn->query($sql_mq138);
$data_mq138 = $result_mq138->fetch_assoc();

// Combinar los datos en un solo array
$data = array(
    "sds011" => $data_sds011,
    "mq138" => $data_mq138
);

// Retornar los datos en formato JSON
echo json_encode($data);

$conn->close();
?>
