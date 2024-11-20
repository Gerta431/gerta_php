<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root". "");

    $sql = "ALTER TABLE users DROP COLUMN email";

    $pdo -> exec($sql);

    echo "column deleted succesfully";
}catch(PDOExeption $e){
    echo "Error deleted column: ".$e->getmessage();
}
?>