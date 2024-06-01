<?php
session_start();
// require_once '../app/init.php';
$con = mysqli_connect("localhost", "root", "", "ample");

if(isset($_POST['save_multiple_data']))
{
    $product_names = $_POST['p_product_name'];
    $purchase_dates = $_POST['puchar_date'];
    $supplier_names = $_POST['p_supliar'];
    $purchase_quantities = $_POST['p_pn_quantity'];
    $Stock_quantites=$_POST['p_p_quantity'];
    $Buy_Price=$_POST['p_p_price'];
    $invoice=$_POST['in_name'];

    foreach ($product_names as $index => $product_name) {
        $purchase_date = $purchase_dates[$index];
        $supplier_name = $supplier_names[$index];
        $Stock_quantity =$Stock_quantites[$index]; 
        $purchase_quantity = $purchase_quantities[$index];
        $purchase=$Buy_Price[$index];
        $invoiceNumber=$invoice[$index];

        $query2="select product_name from products where id=$product_name";
        $query_run2 = mysqli_query($con, $query2);
       
        if ($query_run2) {
            $row = mysqli_fetch_assoc($query_run2);
            $product_name2 = $row['product_name'];
        
        $query = "INSERT INTO sample (product_id,product_name, purchase_date, supplier_name, prev_quantity, purchase_quantity, purchase_price, InvoiceNumber)VALUES('$product_name','$product_name2','$purchase_date', '$supplier_name',' $Stock_quantity',' $purchase_quantity','$purchase','$invoiceNumber')";
        $query_run = mysqli_query($con, $query);
        }

    }

    foreach ($product_names as $index => $product_name) {
    
        $purchase_quantity = $purchase_quantities[$index]; 

        // Update the products table
        $sql = "UPDATE products SET quantity = quantity +  $purchase_quantity WHERE id = $product_name";
    
        if ($con->query($sql) === TRUE) {
            echo "Product with ID  updated successfully.<br>";
        } else {
            echo "Error updating product with ID : " . $con->error . "<br>";
        }
    }

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: http://localhost/ample/index.php?page=buy_product");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        //header("Location: insert-multiple-data.php");
        exit(0);
    }
}
?>