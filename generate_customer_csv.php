<?php
$conn = new mysqli("localhost", "root", "", "register");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="customer_report.csv"');

$output = fopen('php://output', 'w');

// Get data from `customers` table
$result = $conn->query("SELECT * FROM users");

// Output column headers
if ($result->num_rows > 0) {
    $headers = array();
    while ($fieldinfo = $result->fetch_field()) {
        $headers[] = $fieldinfo->name;
    }
    fputcsv($output, $headers);

    // Output data rows
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
exit;
