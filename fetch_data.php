<?php
include 'conexion.php';

$table = $_POST['table'];
$date = $_POST['date'];

if ($table == 'lectura_sds011') {
    $sql = "SELECT pm10, pm25, fecha_hora AS date FROM lectura_sds011 WHERE DATE(fecha_hora) = '$date'";
} else if ($table == 'lectura_mq138') {
    $sql = "SELECT valor AS value, fecha_hora AS date FROM lectura_mq138 WHERE DATE(fecha_hora) = '$date'";
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
