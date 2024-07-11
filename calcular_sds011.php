<?php
header('Content-Type: application/json');

include 'conexion.php';

// Obtener la primera y última fecha de los datos
$sql = "SELECT MIN(fecha_hora) AS start_time, MAX(fecha_hora) AS end_time FROM lectura_sds011";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$row = $result->fetch_assoc();
$start_time = new DateTime($row['start_time']);
$end_time = new DateTime($row['end_time']);

// Redondear hacia abajo al inicio de la primera hora completa
$start_time->setTime($start_time->format('H'), 0, 0);
// Redondear hacia abajo al inicio de la última hora completa
$end_time->setTime($end_time->format('H'), 0, 0);

// Calcular promedios para cada hora
$current_time = clone $start_time;
while ($current_time <= $end_time) {
    $next_time = clone $current_time;
    $next_time->modify('+1 hour');

    $stmt = $conn->prepare("
        SELECT AVG(pm10), AVG(pm25)
        FROM lectura_sds011
        WHERE fecha_hora >= ? AND fecha_hora < ?
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

        // Verificar si ya existe un registro para esta hora
        $check_stmt = $conn->prepare("
            SELECT COUNT(*) FROM prom_sds011 WHERE hora_inicio = ?
        ");
        if (!$check_stmt) {
            die("Error en la preparación de la consulta de verificación: " . $conn->error);
        }
        $check_stmt->bind_param("s", $current_time_str);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            // Actualizar el registro existente
            $update_stmt = $conn->prepare("
                UPDATE prom_sds011 SET prom_pm10 = ?, prom_pm25 = ?, estado = ? WHERE hora_inicio = ?
            ");
            if (!$update_stmt) {
                die("Error en la preparación de la consulta de actualización: " . $conn->error);
            }
            $update_stmt->bind_param("ddss", $prom_pm10, $prom_pm25, $estado, $current_time_str);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            // Insertar un nuevo registro
            $insert_stmt = $conn->prepare("
                INSERT INTO prom_sds011 (prom_pm10, prom_pm25, hora_inicio, estado)
                VALUES (?, ?, ?, ?)
            ");
            if (!$insert_stmt) {
                die("Error en la preparación de la consulta de inserción: " . $conn->error);
            }
            $insert_stmt->bind_param("ddss", $prom_pm10, $prom_pm25, $current_time_str, $estado);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
    }

    $current_time = $next_time;
}

$conn->close();

echo "Promedios históricos calculados y registrados correctamente.";
?>
