<?php

// Assuming you have already included/initiated the necessary connections, functions, and objects
require_once '../init.php';

if (isset($_POST)) {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $invoice_id = $_SESSION['invoice'];
    $pro_name = $_POST['pro_name'][0];
    $returnQty = $_POST['returnQty'][0];
    $sellPrice = $_POST['sellPrice'][0];
    $return_date = $obj->convertDateMysql($_POST['return_date']);

    // Prepare SQL statement for insertion
    $stmt = $pdo->prepare("INSERT INTO `sell_return`(`customer_id`,`customer_name`, `invoice_id`, `return_date`, `amount`, `return_quantity`,`product_name`) VALUES (?,?,?,?,?,?,?)");

    // Bind parameters
    $stmt->bindParam(1, $customer_id , PDO::PARAM_INT);
    $stmt->bindParam(2, $customer_name , PDO::PARAM_STR);
    $stmt->bindParam(3, $invoice_id , PDO::PARAM_STR);
    $stmt->bindParam(4, $return_date , PDO::PARAM_STR);
    $stmt->bindParam(5, $sellPrice , PDO::PARAM_STR);
    $stmt->bindParam(6, $returnQty , PDO::PARAM_STR);
    $stmt->bindParam(7, $pro_name , PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute() or die("Failed to insert data into sell_return table.");

    // Get the last insert ID
    $return_no = $pdo->lastInsertId();

    // Check if insertion was successful
    if ($return_no) {
        echo "Sell return record inserted successfully with ID: $return_no";

        // Update products table with returned quantity
        $updateStmt = $pdo->prepare("UPDATE `products` SET `quantity` = `quantity` + ? WHERE `product_name` = ?");
        $updateStmt->bindParam(1, $returnQty , PDO::PARAM_STR);
        $updateStmt->bindParam(2, $pro_name , PDO::PARAM_STR);
        $updateStmt->execute();

        unset($_SESSION['invoice']);
    } else {
        echo "Failed to insert sell return record. Please try again.";
        unset($_SESSION['invoice']);
    }
}
?>
