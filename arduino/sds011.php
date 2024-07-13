<?php
    include_once 'connect.php';
    if(isset($_GET['pm10']) && isset($_GET['pm25'])){
    $temp = $_GET['pm10'];
    $hum = $_GET['pm25'];
    
    $query = "INSERT INTO lectura_sds011 (pm10, pm25) VALUES (".$pm10.", ".$pm25.")";
    
    $res = $conn->query($query);
    
    if($res){
        echo "GUARDADO";
    }else{
        echo "NO GUARDADO";
    }
    
    }