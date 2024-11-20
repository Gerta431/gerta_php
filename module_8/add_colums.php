<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=mydb", "root". "");

    $sql = "ALTER TABLE users ADD email VARCHAR(255)";

    $pdo -> exec($sql);

    echo "column created succesfully";
}catch(PDOExeption $e){
    echo "Error creating column: ".$e->getmessage();
}
?>