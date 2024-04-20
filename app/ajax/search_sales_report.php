<?php 
require_once '../init.php';
	if (isset($_POST) && !empty($_POST)) {
		 $issueData = $_POST['issuedate'];
		 $customer = $_POST['customer'];


		$data = explode('-', $issueData);
	  $issu_first_date = $obj->convertDateMysql($data[0]);
		$issu_end_date = $obj->convertDateMysql($data[1]);

	if ($customer == 'all') {
    $stmt = $pdo->prepare("SELECT * FROM `invoice` WHERE `order_date` BETWEEN '$issu_first_date' AND '$issu_end_date'");
    $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_OBJ);
      if ($res) {
        ?>
          <?php 
          $i=0;
              foreach ($res as $data) {
                $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$data->invoice_number;?></td>
                    <td><?=$data->order_date;?></td>
                    <td><?=$data->customer_id;?></td>
                    <td><?=$data->customer_name;?></td>
                   
                <?php 
              }
           ?>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <!-- <th>Total : </th> -->
          
        </tr>
        <?php 
      }else{
         echo "no data found"; 
      }
  }else{
    $stmt = $pdo->prepare("SELECT * FROM `invoice` WHERE `order_date` BETWEEN '$issu_first_date' AND '$issu_end_date' AND `customer_id` = $customer");
    $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_OBJ);

       if ($res) {
        ?>
          <?php 
          $i=0;
              foreach ($res as $data) {
                $i++;
                ?>
                   <tr>
                    <td><?=$i;?></td>
                    <td><?=$data->invoice_number;?></td>
                    <td><?=$data->order_date;?></td>
                    <td><?=$data->customer_id;?></td>
                    <td><?=$data->customer_name;?></td>
                    
                  </tr>
                <?php 
              }
           ?>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <!-- <th>Total : </th> -->
         
        </tr>
        <?php 
      }else{
         echo "<p class='pt-1' style='text-align:center;'>"."no data found"."</p>"; 
      }
  }

	   


	}
 ?>