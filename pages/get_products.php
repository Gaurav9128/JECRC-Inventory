<?php
// Database connection
$mysqli = mysqli_connect("localhost", "root", "", "ample");
 
// Fetch products
$query = "SELECT id, name FROM products";
$result = $mysqli->query($query);

$options = "";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='{$row['id']}'>{$row['name']}</option>";
}

echo $options;

$mysqli->close();
?>
