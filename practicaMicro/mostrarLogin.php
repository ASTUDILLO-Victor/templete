<?php
    include_once "conexion.php";
    $sql = "SELECT * FROM estados;";
    $resultado = $conn->query($sql);

    if($resultado){
        while ($row = mysqli_fetch_assoc($resultado))
   {
    echo $row['personaCerca'];
   }
        
    }else{
        echo "0";
    }