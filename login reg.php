<?php
include 'login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check for empty fields
    if ($name === '' || $email === '' || $password === '') {
        die("All fields are required!");
    }

    // Escape values
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email already exists
    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        die("Error: Email already registered!");
    }

    // Insert new user
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>