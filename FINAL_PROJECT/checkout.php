<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];


    $sql = "SELECT * FROM clothes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "Item not found.";
        exit();
    }
} else {
    echo "No item selected.";
    exit();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #34495e;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .item-details img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .item-details div {
            max-width: 65%;
        }
        .item-details h2 {
            font-size: 1.5rem;
            color: #2c3e50;
        }
        .item-details p {
            color: #7f8c8d;
        }
        .checkout-btn {
            width: 100%;
            padding: 15px;
            background-color: #27ae60;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .checkout-btn:hover {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Checkout</h1>


    <div class="item-details">
        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
        <div>
            <h2><?php echo $item['name']; ?></h2>
            <p><strong>Description:</strong> <?php echo $item['description']; ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($item['price'], 2); ?></p>
        </div>
    </div>

    <
    <form action="purchase.php" method="POST">
        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
        <input type="hidden" name="item_name" value="<?php echo $item['name']; ?>">
        <input type="hidden" name="item_price" value="<?php echo $item['price']; ?>">
        
        <button type="submit" class="checkout-btn">Proceed to Checkout</button>
    </form>
</div>

</body>
</html>
