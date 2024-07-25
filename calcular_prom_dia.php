<?php
header('Content-Type: application/json');

include 'conexion.php';

// Obtener la primera y última fecha de los datos
$sql = "SELECT MIN(hora_inicio) AS start_time, MAX(hora_inicio) AS end_time FROM prom_sds011";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$row = $result->fetch_assoc();
$start_time = new DateTime($row['start_time']);
$end_time = new DateTime($row['end_time']);

// Redondear hacia abajo al inicio del día
$start_time->setTime(0, 0, 0);
$end_time->setTime(23, 59, 59);

// Calcular promedios para cada día
$current_time = clone $start_time;
while ($current_time <= $end_time) {
    $next_time = clone $current_time;
    $next_time->modify('+1 day');

    $stmt = $conn->prepare("
        SELECT AVG(prom_pm10), AVG(prom_pm25)
        FROM prom_sds011
        WHERE hora_inicio >= ? AND hora_inicio < ?
    ");

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $current_time_str = $current_time->format('Y-m-d H:i:s');
    $next_time_str = $next_time->format('Y-m-d H:i:s');
    $stmt->bind_param("ss", $current_time_str, $next_time_str);
    $stmt->execute();
    $stmt->bind_result($prom_pm10, $prom_pm25);
    $stmt->fetch();
    $stmt->close();

    if ($prom_pm10 !== null && $prom_pm25 !== null) {
        $estado = ($prom_pm10 >= 100 || $prom_pm25 >= 50) ? 'Elevado' : 'No Elevado';
        $fecha = $current_time->format('Y-m-d');

        // Intentar insertar un nuevo registro
        $insert_stmt = $conn->prepare("
            INSERT INTO promedio_sds011 (promedio_pm10, promedio_pm25, fecha, estado)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE promedio_pm10 = VALUES(promedio_pm10), promedio_pm25 = VALUES(promedio_pm25), estado = VALUES(estado)
        ");

        if (!$insert_stmt) {
            die("Error en la preparación de la consulta de inserción: " . $conn->error);
        }

        $insert_stmt->bind_param("ddss", $prom_pm10, $prom_pm25, $fecha, $estado);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $current_time = $next_time;
}

$conn->close();

echo "Promedios diarios calculados y registrados correctamente.";
?>
