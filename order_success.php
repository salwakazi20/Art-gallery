<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ✅ Use absolute path
include('E:/xampp/htdocs/website/php/db_connect.php');

// ✅ Check DB connection
if (!$conn) {
    die("Connection failed.");
}


// ✅ Get order_id from URL safely
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// ✅ Fetch order from the database
$sql = "SELECT * FROM payments WHERE id = $order_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $order = $result->fetch_assoc();
    $product_name = $order['product_name'];
    $total_price = $order['total_price'];
    $total_discount = $order['total_discount'];
    $order_total = $order['order_total'];
    $payment_method = $order['payment_method'];
    $order_date = $order['order_date'];
} else {
    echo "Order not found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Order Placed Successfully ✅</h2>

    <div class="order-details">
        <p><strong>Product Name:</strong> <?php echo htmlspecialchars($product_name); ?></p>
        <p><strong>Total Price:</strong> ₹<?php echo $total_price; ?></p>
        <p><strong>Total Discount:</strong> ₹<?php echo $total_discount; ?></p>
        <p><strong>Order Total:</strong> ₹<?php echo $order_total; ?></p>
        <p><strong>Payment Method:</strong> <?php echo ucfirst($payment_method); ?></p>
        <p><strong>Order Date:</strong> <?php echo $order_date; ?></p>
    </div>

    <div class="download-link">
        <p><a href="generate_bill.php?id=<?php echo $order_id; ?>" download>⬇ Download Bill</a></p>
    </div>

</body>
</html>
