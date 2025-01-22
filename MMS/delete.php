<?php
include_once('comfig.php')

$id = $_GET['id'];

$sql = "DELETE FROM movies WHERE id = '$id'";

$prep = $conn->prepare($sql);

$prep ->bindParam(':id' ,$id);

$prep->execute();

header("Loaction: list_movies.php")
?>