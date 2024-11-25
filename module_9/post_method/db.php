<?php
$server = "localhost";
$username = "root";
$dbname = "another_db";

try{
    $connect = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    echo "connected!!!"
}catch(PDOExeption $e){
    echo "something went wrong!!";
}

?>