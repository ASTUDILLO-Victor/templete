<?php
    $servername = "localhost";
    $database = "u246287323_practicamicro";
    $username = "u246287323_user";
    $password = "6JwGz180";

    $conn = new mysqli($servername, $username, $password, $database, 3306);

    $conn->set_charset("utf8");

    if($conn->connect_errno){
        echo "ERROR";
        exit();
    }
?>