<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "ample");

// Get product ID from request
$product_id = $_GET['product_id'];

// Fetch stock quantity
$query = "SELECT quantity FROM products WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$stmt->bind_result($stock_quantity);
$stmt->fetch();

echo $stock_quantity;

$stmt->close();
$con->close();
?>
