<?php
include 'conexion.php';

// Obtener el último estado del relé
$sql = "SELECT action FROM relay_log ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output del estado del relé
  $row = $result->fetch_assoc();
  echo $row['action'];
} else {
  echo "off"; // Si no hay registros, asumir que el relé está apagado
}

$conn->close();
?>
