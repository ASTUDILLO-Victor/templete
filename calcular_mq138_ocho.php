<?php
header('Content-Type: application/json');

include 'conexion.php';

// Obtener la primera y última fecha de los datos
$sql = "SELECT MIN(hora_inicio) AS start_time, MAX(hora_inicio) AS end_time FROM prom_mq138";
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

// Definir los intervalos de 8 horas
$intervalos = [
    ['start' => '00:00:00', 'end' => '07:59:59'],
    ['start' => '08:00:00', 'end' => '15:59:59'],
    ['start' => '16:00:00', 'end' => '23:59:59'],
];

// Recorrer cada día y cada intervalo
$current_time = clone $start_time;
while ($current_time <= $end_time) {
    foreach ($intervalos as $intervalo) {
        // Usar variables para los tiempos
        $start_time_str = $intervalo['start'];
        $end_time_str = $intervalo['end'];
        
        $start_interval = clone $current_time;
        $start_interval->setTime(...explode(':', $start_time_str));
        $end_interval = clone $current_time;
        $end_interval->setTime(...explode(':', $end_time_str));

        $stmt = $conn->prepare("
            SELECT AVG(prom_valor)
            FROM prom_mq138
            WHERE hora_inicio >= ? AND hora_inicio <= ?
        ");

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $start_interval_str = $start_interval->format('Y-m-d H:i:s');
        $end_interval_str = $end_interval->format('Y-m-d H:i:s');
        $stmt->bind_param("ss", $start_interval_str, $end_interval_str);
        $stmt->execute();
        $stmt->bind_result($prom_valor);
        $stmt->fetch();
        $stmt->close();

        if ($prom_valor !== null) {
            $estado = ($prom_valor >= 200) ? 'Elevado' : 'No Elevado';
            
            // Ajustar la hora de finalización al próximo intervalo en punto
            $fecha = clone $end_interval;
            $fecha->modify('+1 minute'); // Avanzar un minuto para asegurar que sea el próximo intervalo en punto
            $fecha->setTime($fecha->format('H'), 0, 0); // Establecer minuto y segundo a cero

            // Intentar insertar un nuevo registro
            $insert_stmt = $conn->prepare("
                INSERT INTO promedio_mq138 (promedio_valor, fecha, estado)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE promedio_valor = VALUES(promedio_valor), estado = VALUES(estado)
            ");

            if (!$insert_stmt) {
                die("Error en la preparación de la consulta de inserción: " . $conn->error);
            }

            $insert_stmt->bind_param("dss", $prom_valor, $fecha->format('Y-m-d H:i:s'), $estado);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
    }

    // Mover al siguiente día
    $current_time->modify('+1 day');
}

$conn->close();

echo json_encode(["message" => "Promedios de 8 horas calculados y registrados correctamente."]);
?>
