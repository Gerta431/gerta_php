<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothing_store";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);


    $sql = "SELECT * FROM users WHERE username = '$input_username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $error = "Username already exists!";
    } else {

        $sql = "INSERT INTO users (username, password) VALUES ('$input_username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9; margin: 0; }
        .register-container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #555; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>