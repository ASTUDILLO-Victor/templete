<?php
include 'conexion.php';

$table = $_POST['table'];
$date = $_POST['date'];
$data = array();

if ($table == 'lectura_sds011') {
    $sql = "SELECT id_prom, prom_pm10, prom_pm25, hora_inicio, estado FROM prom_sds011 WHERE DATE(hora_inicio) = '$date'";
} else if ($table == 'lectura_mq138') {
    $sql = "SELECT id_pro, prom_valor, hora_inicio, estado FROM prom_mq138 WHERE DATE(hora_inicio) = '$date'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
