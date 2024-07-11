<?php
$servername = "localhost";
$username = "u246287323_root";
$password = "u1|G9Qd|9V";
$dbname = "u246287323_airsafe";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
