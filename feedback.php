<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // No password for XAMPP default MySQL root user
$database = "website_feedback";

// Database connection - directly pass empty string for password
$conn = new mysqli("localhost", "root", "", "website_feedback");

// Check connection
if ($conn->connect_error) {
    // Log error and show a generic message
    error_log("Connection failed: " . $conn->connect_error);
    die("Error connecting to the database. Please try again later.");
}

// Get and sanitize form data
$full_name = isset($_POST['fname']) ? trim($_POST['fname']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$review = isset($_POST['msg']) ? trim($_POST['msg']) : '';

// Basic validation
if (empty($full_name) || empty($email) || empty($review)) {
    die("All fields are required. Please fill out the form completely.");
}

// Sanitize email (basic sanitization)
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Prepare and bind (to prevent SQL injection)
$stmt = $conn->prepare("INSERT INTO feedback (fname, email, review) VALUES (?, ?, ?)");
if ($stmt === false) {
    // Log error if statement preparation fails
    error_log("Database prepare error: " . $conn->error);
    die("Database error. Please contact support.");
}

// Bind parameters and execute statement
$stmt->bind_param("sss", $full_name, $email, $review);

if ($stmt->execute()) {
    echo "Feedback submitted successfully!";
} else {
    // Log error if execution fails
    error_log("Execute error: " . $stmt->error);
    echo "Error submitting feedback. Please try again later.";
}

// Close connection
$stmt->close();
$conn->close();
?>
