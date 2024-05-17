<?php 
require_once '../init.php';

if (isset($_POST['customer_name']) && isset($_POST['orderdate'])) {
    $invoice_number = "S" . time();
    $customer_name = $_POST['customer_name'];
    $find_customer_name = $obj->find('member', 'id', $customer_name);
    $find_customer_name = $find_customer_name->name;
    $orderdate = $obj->convertDateMysql($_POST['orderdate']);

    //$total_quantity = $_POST['total_quantity'];
    $orderQuantity = $_POST['p_pn_quantity'];
    $pro_name = $_POST['product_name'];
    $find_pro_name = $obj->find('products', 'id', $pro_name);
    $find_pro_name = $find_pro_name->product_name;

    $subtotal = $_POST['subtotal'];
    $discount = $_POST['s_discount_amount'];
    $prev_due = $_POST['prev_due'];
    $netTotal = $_POST['netTotal'];
    $paidBill = $_POST['paidBill'];
    $dueBill = $_POST['dueBill'];
    $payMethode = $_POST['payMethode'];

    if (!empty($customer_name)) {
        $query = array(
            'invoice_number' => $invoice_number,
            'customer_id' => $customer_name,
            'customer_name' => $find_customer_name,
            'order_date' => $orderdate,
            'sub_total' => $subtotal,
            'discount' => $discount,
            'pre_cus_due' => $prev_due,
            'net_total' => $netTotal,
            'paid_amount' => $paidBill,
            'due_amount' => $dueBill,
            'product_name' => $find_pro_name,
            'payment_type' => '',
            'issue_quantity' => $orderQuantity,
        );

        // Insert invoice details
        $res = $obj->create('invoice', $query);

        if ($res) {
            // Update product quantity
            $stmt = $pdo->prepare("UPDATE products SET quantity = quantity - :order_quantity WHERE id = :pro_id");
            $stmt->execute(array(':order_quantity' => $orderQuantity, ':pro_id' => $pro_name));

            // Add payment details to customer balance table if needed
            // $add_py_query = array(
            //     'cus_id' => $laset_id,
            //     'due_blance' => $cus_open_blacnce,
            // );
            // $res = $obj->create('customer_balance', $add_py_query);
            echo "yes";
        } else {
            echo "Failed to add invoice. please try again";
        }
    } else {
        echo "Name field required";
    }
}
?>