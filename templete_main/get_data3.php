<?php
header('Content-Type: application/json');

include 'conexion.php';

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    // Echoing for debugging purposes
    //echo "Fecha solicitada: $date\n";

    $sql = "SELECT fecha_hora, valor FROM lectura_mq138 WHERE DATE(fecha_hora) = '$date'";
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
