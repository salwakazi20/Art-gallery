<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $sql = "SELECT * FROM payments WHERE id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>Invoice</h2>";
        echo "Total Price: ₹" . $row["total_price"] . "<br>";
        echo "Total Discount: ₹" . $row["total_discount"] . "<br>";
        echo "Order Total: ₹" . $row["order_total"] . "<br>";
        echo "Order Date: " . $row["order_date"] . "<br>";
    } else {
        echo "Order not found!";
    }
}
$conn->close();
?>