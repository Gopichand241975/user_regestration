<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_demo";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $user, $email, $pass);
        if ($stmt->execute()) {
            echo "<h3 style='text-align:center;color:green;'>Registration successful!</h3>";
        } else {
            echo "<h3 style='text-align:center;color:red;'>Something went wrong. Try again.</h3>";
        }
        $stmt->close();
    } else {
        echo "<h3 style='text-align:center;color:red;'>Error preparing statement!</h3>";
    }
}

$conn->close();
?>