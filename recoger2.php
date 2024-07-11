<?php
// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Consulta para obtener todos los datos del sensor
$sqlAll = "SELECT id_lectura, pm10, pm25, fecha_hora FROM lectura_sds011 ORDER BY fecha_hora DESC";
$queryAll = $pdo->prepare($sqlAll);
$queryAll->execute();
$allData = $queryAll->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener el último dato del sensor
$sqlLast = "SELECT id_lectura, pm10, pm25, fecha_hora FROM lectura_sds011 ORDER BY fecha_hora DESC LIMIT 1";
$queryLast = $pdo->prepare($sqlLast);
$queryLast->execute();
$lastData = $queryLast->fetch(PDO::FETCH_ASSOC);

// Crear el array de respuesta
$response = [
    'allData' => $allData,
    'lastData' => $lastData
];

echo json_encode($response);
?>
