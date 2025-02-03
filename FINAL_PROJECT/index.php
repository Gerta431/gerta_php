<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM clothes";
$result = $conn->query($sql);

$clothes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clothes[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing Store</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; padding: 20px; }
        .clothes-container { display: flex; flex-wrap: wrap; justify-content: center; margin-top: 20px; }
        .clothing-item { width: 200px; margin: 15px; padding: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .clothing-item img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
        .clothing-item h3 { text-align: center; }
        .clothing-item p { text-align: center; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to the Clothing Store, <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php">Logout</a>
    </div>

    <div class="clothes-container">
        <?php foreach ($clothes as $item): ?>
            <div class="clothing-item">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                <h3><?php echo $item['name']; ?></h3>
                <p><?php echo $item['description']; ?></p>
                <p><strong>$<?php echo number_format($item['price'], 2); ?></strong></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>