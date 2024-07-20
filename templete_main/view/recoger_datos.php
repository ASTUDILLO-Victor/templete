<?php

$host = 'localhost';            // Dirección del servidor
$db   = 'proyecto';// Nombre de la base de datos
$user = 'root';                 // Nombre de usuario
$pass = '';                    // Contraseña del usuario (un espacio en blanco)
$charset = 'utf8mb4';           // Juego de caracteres

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Data Source Name

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Modo de errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Modo de fetch
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Emular sentencias preparadas
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    //echo "Conexión exitosa.";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
switch($_GET['q']){
    //buscar ultimo dato
    case 1:
        $statement=$pdo->prepare("SELECT temperatura, humedad FROM sensor ORDER BY Id DESC Limit 0,1");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $json=json_encode($results);
        echo $json;
    break;
    //buscar todos los datos
    default:

        $statement=$pdo->prepare("SELECT temperatura, humedad FROM sensor ORDER BY Id ASC");
        $statement->execute();
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $json=json_encode($results);
        echo $json;
}
?>
