<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete' && isset($_POST['id'])) {
        $sql = "DELETE FROM clothes WHERE id = " . $_POST['id'];
        $conn->query($sql);
    }
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
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        .btn { background-color: #333; color: white; padding: 5px 10px; border: none; cursor: pointer; }
        .btn:hover { background-color: #555; }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($clothes as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td>$<?php echo number_format($item['price'], 2); ?></td>
                <td>
                    <form action="admin.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button class="btn" type="submit" name="action" value="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>