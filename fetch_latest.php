<?php
include 'conexion.php';


// Consultar el último registro
$sql = "SELECT id, action, descripcion, timestamp FROM relay_log ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'data' => $row]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No hay registros']);
}

$conn->close();
?>
