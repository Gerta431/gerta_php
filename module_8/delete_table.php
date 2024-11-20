<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root". "");

    $sql = "DROP TABLE users";

    $pdo -> exec($sql);

    echo "table dropped succesfully";
}catch(PDOExeption $e){
    echo  $e->getmessage();
}
?>