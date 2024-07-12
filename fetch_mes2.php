<?php
include 'conexion.php';

$periodo = $_POST['periodo'];
$mes = $_POST['mes'];
$data = array();

if ($periodo == 'diario') {
    $sql = "SELECT DATE(hora_inicio) as fecha, AVG(prom_valor) as promedio_valor FROM prom_mq138 WHERE DATE_FORMAT(hora_inicio, '%Y-%m') = '$mes' GROUP BY DATE(hora_inicio)";
} else if ($periodo == 'mensual') {
    $sql = "SELECT DATE_FORMAT(hora_inicio, '%Y-%m') as fecha, AVG(prom_valor) as promedio_valor FROM prom_mq138 GROUP BY DATE_FORMAT(hora_inicio, '%Y-%m')";
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
