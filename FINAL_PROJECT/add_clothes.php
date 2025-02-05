<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name']; 

    $target_dir = "index.php";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['index.php'], $target_file);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clothing_store";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "INSERT INTO clothes (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New clothing item added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }                   
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Clothing</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .container { width: 50%; margin: 50px auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        label { font-weight: bold; display: block; margin: 10px 0; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc; }
        input[type="submit"] { background-color: #333; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #555; }
        .form-group { margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Clothing Item</h2>
    


    <form action="add_clothes.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Clothing Name:</label>
            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" value="" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <input type="submit" value="Add Clothing Item">
    </form>




</div>

</body>
</html>
