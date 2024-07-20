<?php
    include_once 'connect.php';
    if(isset($_GET['temperatura']) && isset($_GET['humedad'])){
    $temp = $_GET['temperatura'];
    $hum = $_GET['humedad'];
    
    $query = "INSERT INTO ambiente (temperatura, humedad) VALUES (".$temp.", ".$hum.")";
    
    $res = $conn->query($query);
    
    if($res){
        echo "GUARDADO";
    }else{
        echo "NO GUARDADO";
    }
    
    }