<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];




    echo "<h1>Thank you for your purchase!</h1>";
    echo "<p>You bought: <strong>$item_name</strong></p>";
    echo "<p>Price: $<strong>$item_price</strong></p>";


} else {
    echo "No data received!";
}
?>
