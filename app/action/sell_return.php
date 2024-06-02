<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../init.php';

if (isset($_POST)) {
    $customer_id = $_POST['customer_id'];
    $email = $_POST['email'];
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
?>
<?php
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

  $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'gjain212000@gmail.com';   //SMTP write your email
    $mail->Password   = 'slol uogt nukk gfku';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( $email, $customer_name); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email  
    $mail->addReplyTo($email, $customer_name); // reply to sender email
$msg="Name:".$customer_name."<br> Return date:".$return_date."<br>Product Name:".$pro_name."<br>Return Quantity:".$returnQty."<br>Sell Price:".$sellPrice;
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = "Return sales";   // email subject headings
    $mail->Body    =$msg; //email message

    // Success sent message alert
    $mail->send();
   
?>
<?php
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
