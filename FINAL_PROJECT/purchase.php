<?php
session_start();

// Make sure item data is passed to the page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];

    // Process payment here, e.g., through a payment gateway

    // For simplicity, we can just show a confirmation message
    echo "<h1>Thank you for your purchase!</h1>";
    echo "<p>You bought: <strong>$item_name</strong></p>";
    echo "<p>Price: $<strong>$item_price</strong></p>";
    // Optionally, you can also save the order details to a database here

} else {
    echo "No data received!";
}
?>
