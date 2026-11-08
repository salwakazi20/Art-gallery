<?php
// Database connection details
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

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];

// Check if password and confirm password match
if ($pass !== $confirm_pass) {
    die("Passwords do not match. Please <a href='../signup.html'>try again</a>.");
}

// Insert into database
$sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful! You can now <a href='../login_form.html'>Login here</a>.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>