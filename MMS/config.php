<?php
$server = "localhost";
$dbname = "mms";
$user = "root";
$pass = "";

try{
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
}catch(PDOExeption $e){
    echo "error: ".$e.getMessage();
}
?>