<?php
include 'login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); // Debugging line to check if values are received

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        die("Email and Password are required.");
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>