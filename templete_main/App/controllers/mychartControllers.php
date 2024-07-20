<?php
namespace App\controllers;

use PDOException;
use App\models\Task;
use App\models\empleado;

class mychartController
{
    public function mychart()
    {
        
        try {
          $pdo = new \PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
          $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          die("Error al conectar a la base de datos: " . $e->getMessage());
        }
        
        $sql = "SELECT id, sensor1, sensor2, fecha_actual FROM sensor ORDER BY fecha_actual DESC";
        $query = $pdo->prepare($sql);
        $query->execute();
        $sensor = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        echo json_encode($sensor);
       
        
    }

}