<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
        .clothing-item { width: 220px; margin: 20px; padding: 15px; background-color: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; overflow: hidden; text-align: center; }
        .clothing-item:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); }
        .clothing-item img { width: 100%; height: 250px; object-fit: cover; border-radius: 8px; transition: transform 0.3s ease; }
        .clothing-item img:hover { transform: scale(1.05); }
        .clothing-item h3 { font-size: 1.6rem; color: #34495e; margin: 10px 0; font-weight: bold; }
        .clothing-item p { color: #7f8c8d; font-size: 1rem; margin: 10px 0; line-height: 1.5; }
        .clothing-item strong { font-size: 1.2rem; color: #e74c3c; }
        .buy-button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .buy-button:hover {
            background-color: #2980b9;
        }

    </style>
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

            <button class="buy-button" onclick="window.location.href='checkout.php?item_id=<?php echo $item['id']; ?>'">Buy</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button onclick="window.location.href='add_clothes.php';">Add new clothes here!</button>
    <button onclick="window.location.href='admin.php';">Admin!</button>

    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .header {
        background-color: #bbbbbb;
        color: white;
        padding: 30px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
        font-size: 2.5rem;
        margin: 0;
    }

    .header a {
        display: inline-block;
        margin-top: 15px;
        color: black;
        font-size: 1.2rem;
        text-decoration: none;
        padding: 10px 20px;
        background-color: #ecf0f1;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .header a:hover {
        background-color: #bdc3c7;
    }

    .clothes-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 30px;
        padding: 0 20px;
    }

    .clothing-item {
        width: 220px;
        margin: 20px;
        padding: 15px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        text-align: center;
    }

    .clothing-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .clothing-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .clothing-item img:hover {
        transform: scale(1.05);
    }

    .clothing-item h3 {
        font-size: 1.6rem;
        color: #34495e;
        margin: 10px 0;
        font-weight: bold;
    }

    .clothing-item p {
        color: #7f8c8d;
        font-size: 1rem;
        margin: 10px 0;
        line-height: 1.5;
    }

    .clothing-item strong {
        font-size: 1.2rem;
        color: #e74c3c;
    }

    button {
        background-color: #bbbbbb;
        color: white;
        font-size: 1rem;
        border: none;
        padding: 12px 20px;
        margin: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    button:hover {
        background-color: #a1a1a1 ;
        transform: scale(1.05);
    }

    button:active {
        background-color: #bbbbbb;
    }

    button:focus {
        outline: none;
    }

    @media (max-width: 768px) {
        .clothes-container {
            flex-direction: column;
            align-items: center;
        }

        .clothing-item {
            width: 100%;
            max-width: 320px;
        }

        .header h1 {
            font-size: 2rem;
        }
    }
</style>

</body>
</head>
<body>