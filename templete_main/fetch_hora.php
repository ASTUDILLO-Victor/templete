<?php
include 'conexion.php';

$table = $_POST['table'];
$date = $_POST['date'];
$hour = $_POST['hour'];

// Define start and end times for the selected hour
$start_time = "$date $hour";
$end_time = date("Y-m-d H:i:s", strtotime("$start_time +1 hour"));

if ($table == 'lectura_sds011') {
    $sql = "SELECT id_lectura, pm10, pm25, fecha_hora FROM lectura_sds011 WHERE fecha_hora >= '$start_time' AND fecha_hora < '$end_time'";
} else if ($table == 'lectura_mq138') {
    $sql = "SELECT id_lectura, valor, fecha_hora FROM lectura_mq138 WHERE fecha_hora >= '$start_time' AND fecha_hora < '$end_time'";
}

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    error_log("No data found for the given criteria.");
}

echo json_encode($data);

$conn->close();
?>
