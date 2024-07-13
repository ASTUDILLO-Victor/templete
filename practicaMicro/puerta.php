<?php
    include_once "conexion.php";
    $sql = "SELECT * FROM estados;";
    $resultado = $conn->query($sql);

    if($resultado){
        while ($row = mysqli_fetch_assoc($resultado))
   {
    echo $row['estadoAlarma']; // 0 nada, 1 abrir puerta, 2 alarma  
   }
        
    }else{
        echo "0";
    }