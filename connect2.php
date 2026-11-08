<?php
include 'artist.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['fname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $gender = $_POST['gender'];
    $mobile = $_POST['mob'];
    $biography = $_POST['bio'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);

    // Insert into database
    $sql = "INSERT INTO artists (full_name, email, password, gender, mobile, biography, profile_picture) 
            VALUES ('$full_name', '$email', '$password', '$gender', '$mobile', '$biography', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>