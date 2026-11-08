<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if your MySQL has a password
$dbname = "user"; // Change to your actual database name

// Create a connection if not already connected
if (!isset($conn)) {
    $conn = new mysqli($servername, $username, $password, $dbname);
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>