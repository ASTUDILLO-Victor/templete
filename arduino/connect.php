<?php
$servername = "localhost";
$database = "u246287323_airsafe";
$username = "u246287323_root";
$password = "u1|G9Qd|9V";
 
// Create connection
 
$conn = new mysqli($servername, $username, $password, $database, 3306);
 
$conn->set_charset("utf8");
if($conn->connect_errno){
    echo "ERROR";
    exit();
}
?>