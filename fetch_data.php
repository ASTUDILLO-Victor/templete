<?php
include 'conexion.php';

$table = $_POST['table'];
$date = $_POST['date'];
$hour = $_POST['hour'];

if ($table == 'lectura_sds011') {
    if ($hour == 'all') {
        $sql = "SELECT pm10, pm25, fecha_hora AS date FROM lectura_sds011 WHERE DATE(fecha_hora) = '$date'";
    } else {
        $sql = "SELECT pm10, pm25, fecha_hora AS date FROM lectura_sds011 WHERE DATE(fecha_hora) = '$date' AND HOUR(fecha_hora) = HOUR('$hour')";
    }
} else if ($table == 'lectura_mq138') {
    if ($hour == 'all') {
        $sql = "SELECT valor AS value, fecha_hora AS date FROM lectura_mq138 WHERE DATE(fecha_hora) = '$date'";
    } else {
        $sql = "SELECT valor AS value, fecha_hora AS date FROM lectura_mq138 WHERE DATE(fecha_hora) = '$date' AND HOUR(fecha_hora) = HOUR('$hour')";
    }
}

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>