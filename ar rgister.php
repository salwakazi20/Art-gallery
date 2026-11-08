<?php
// Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "registration";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get Form Data
$full_name = $_POST['fname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$gender = $_POST['gender'];
$mobile = $_POST['mob'];
$bio = $_POST['bio'];

// Handle Profile Picture Upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["pic"]["name"]);
// Ensure the uploads directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Create the folder if it doesn't exist
}

// Move the uploaded file
if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
    echo "File uploaded successfully!";
} else {
    echo "File upload failed!";
}

// Insert Data into Database
$sql = "INSERT INTO artists (full_name, email, password, gender, mobile, bio, profile_pic) 
        VALUES ('$full_name', '$email', '$password', '$gender', '$mobile', '$bio', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "Registration Successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>