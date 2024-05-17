<?php

require_once '../app/init.php';

if (isset($_POST)) {
    
    //$product_id = $_POST['product_id'];
    $product_name = $_POST['p_product_name'];
    $purchase_date = $_POST['puchar_date'];
    $supplier_name = $_POST['p_supliar'];
    $prev_quantity = $_POST['p_p_quantity'];
    $purchase_quantity = $_POST['p_pn_quantity'];

    foreach ($product_name as $index => $p_product_name) {
        //$s_product_id = $product_id[$index];
        $s_product_name = $product_name[$index];
        $s_purchase_date = $purchase_date[$index];
        $s_supplier_name = $supplier_name[$index];
        $s_prev_quantity = $prev_quantity[$index];
        $s_purchase_quantity = $purchase_quantity[$index];

        //echo "name is : " . $product_id;
        echo "Product name is:" .  $p_product_name;
        echo " n is:" .$s_purchase_date;

        if (!empty($s_product_name) && !empty($s_purchase_date) && !empty($s_supplier_name) && !empty($s_prev_quantity) && !empty($s_purchase_quantity)) {
            // Create the data array
            $data = array(
                'product_name' => $s_product_name,
                'purchase_date' => $s_purchase_date,
                'supplier_name' => $s_supplier_name,
                'prev_quantity' => $s_prev_quantity,
                'purchase_quantity' => $s_purchase_quantity,
            );
            
            // Insert the data
            $res = $obj->create('sample', $data);
            if ($res) {
                echo "yes";
            } else {
                echo "Failed to add product";
            }
        } else {
            echo "Please fill out all required fields";
        }
    }

    if ($res) {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: buy_product.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: buy_product.php");
        exit(0);
    }
}

?>
