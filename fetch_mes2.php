<?php
include 'conexion.php';

$periodo = $_POST['periodo'];
$mes = $_POST['mes'];
$data = array();

if ($periodo == 'diario') {
    $sql = "SELECT fecha, promedio_valor, estado FROM promedio_mq138 WHERE DATE_FORMAT(fecha, '%Y-%m') = '$mes' ORDER BY fecha";
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
