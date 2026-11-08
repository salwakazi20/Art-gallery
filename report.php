<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "your_database_name"; // Replace with your DB name

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
