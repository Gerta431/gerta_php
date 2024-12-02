<?php
$host = 'localhost';
$dbname = 'user_management';
$username = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //set PDO error mode to exeption
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected!";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Get from data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    //Validate inputs
    if(empty($user) || empty($email) || empty($pass)){
        echo "All fields are required!!!";
        exit;
    }

    //Hash the password
    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    //Prepare the SQL statement
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);

    //BIND parameters 
    $stmt->bindParam(':username', $user, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

    //execute the statement
    if($stmt->execute()){
        echo "sign up succesfully. You can now log in!!";
    }else{
        echo "something went weong try again!!";
    }
}






}catch(PDOExeption $e){
    //Handle database connection errors
    echo "Error: ". $e->getMessage();
}
?>