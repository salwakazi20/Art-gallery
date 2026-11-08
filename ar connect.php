<?php
$conn = new mysqli("localhost", "root", "", "artist_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!";
}
?>