<?php
$host = "localhost";
$dbname = "user_login";  // your database name
$username = "root";      // default XAMPP user
$password = "";          // default XAMPP has no password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

// Simple security - use prepared statements in real projects
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid credentials.";
}

$conn->close();
?>