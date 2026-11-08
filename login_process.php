<?php
$host = "localhost";
$dbname = "user_login";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$email = $_POST['email'];
$pass = $_POST['password'];  // <- password form field

echo "Entered email: $email<br>";
echo "Entered password: $pass<br>";  // <- use $pass not $password

// Check in database
$sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid credentials.";
}

$conn->close();
?>