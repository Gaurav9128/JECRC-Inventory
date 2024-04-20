
<?php 
  echo "Hi i am"; 
	// Assuming you have already included/initiated the necessary connections, functions, and objects
	
	if (isset($_POST)) {
		// $return_id = $_POST['return_id'];
		$customer_id = $_POST['customer_id'];
		$customer_name = $_POST['customer_name'];
		$invoice_id = 1234;

		// product information
		$pid = $_POST['pid'];
		$pro_name = $_POST['pro_name'];
		$orderQuantity = $_POST['orderQuantity'];
		$returnQty = $_POST['returnQty'];
		$sellPrice = $_POST['sellPrice'];

		// $return_subtotal = $_POST['return_subtotal'];
		// $return_netTotal = $_POST['return_netTotal'];
		$return_date = $obj->convertDateMysql($_POST['return_date']);
		
		// Prepare SQL statement for insertion
		$stmt = $pdo->prepare("INSERT INTO `sell_return`(`customer_name`, `invoice_id`, `return_date`, `amount`) VALUES (?,?,?,?,?)");
		
		// Bind parameters
		$stmt->bindParam(1, $customer_id , PDO::PARAM_INT);
		$stmt->bindParam(2, $customer_name , PDO::PARAM_STR);
		$stmt->bindParam(3, $return_id , PDO::PARAM_STR);
		$stmt->bindParam(4, $return_date , PDO::PARAM_STR);
		// $stmt->bindParam(5, $return_netTotal , PDO::PARAM_STR);
		
		// Execute the statement
		$stmt->execute() or die("Failed to insert data into sell_return table.");

		// Get the last insert ID
		$return_no = $pdo->lastInsertId();

		// Check if insertion was successful
		if ($return_no) {
			echo "Sell return record inserted successfully with ID: $return_no";
		} else {
			echo "Failed to insert sell return record. Please try again.";
		}
	}
?>