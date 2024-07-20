<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array("error" => "Connection failed: " . $conn->connect_error));
    exit();
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    // Echoing for debugging purposes
    //echo "Fecha solicitada: $date\n";

    $sql = "SELECT hour_start,average_sensor1 ,average_sensor2 FROM hourly_averages WHERE DATE(hour_start) = '$date'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo json_encode(array("error" => "SQL error: " . $conn->error));
        exit();
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        // Convertir la fecha al formato ISO 8601 con 'Z' para UTC
        //$row['fecha_actual'] = date('c', strtotime($row['fecha_actual']));
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(array("error" => "Invalid parameters."));
}

$conn->close();
?>
