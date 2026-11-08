ob_start();
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing
    $gender = $_POST['gender'];
    $mob = $_POST['mob'];
    $address = $_POST['address'];

    $sql = "INSERT INTO users (full_name, email, password, gender, mob, address) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $password, $gender, $mob, $address);
    
    if ($stmt->execute()) {
        echo "Data inserted successfully. Redirecting...";
        header("Refresh: 2; URL=../success.html"); // Redirect after 2 seconds
        exit();
    } else {
        die("Database Error: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}
?>
ob_end_flush();