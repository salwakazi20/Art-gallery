<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_price = $_POST['total_price'];
    $total_discount = $_POST['total_discount'];
    $order_total = $_POST['order_total'];

    $sql = "INSERT INTO payments (total_price, total_discount, order_total) VALUES ('$total_price', '$total_discount', '$order_total')";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully! <br> <a href='generate_bill.php?id=" . $conn->insert_id . "'></a>";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>