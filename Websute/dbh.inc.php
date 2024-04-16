<?php

$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = "charles";
$dbpassword = "charles123";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["login"])) {
            // Handle login
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Assuming you have a table named 'users'
            $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username, 'password' => $password]);
            $user = $stmt->fetch();

            if ($user) {
                // Redirect to another page upon successful login
                header("Location: welcome.php");
                exit();
            } else {
                echo "Invalid username or password";
            }
        } elseif (isset($_POST["register"])) {
            // Handle registration
            // Retrieve registration form data
            $username = $_POST["reg_username"];
            $email = $_POST["reg_email"];
            $password = $_POST["reg_password"];

            // Insert user data into the database (you need to implement this)
            // Example SQL query:
            // $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            // Prepare and execute the SQL query

            // After successful registration, redirect to another page
            header("Location: registration_success.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}