<?php 
	require_once '../init.php';
	
	if (isset($_POST)) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$department = $_POST['department'];
		$designation = $_POST['designation'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		$update_at =  date('Y-m-d');

			$query = array(
				'name' => $name,
				'department' => $department,
				'designation' => $designation,
				'address' => $address,
				'con_num' => $contact,
				'email' => $email,
				'update_at' => $update_at,
			);

			$res = $obj->update('member' ,'id',$id, $query);
			if ($res) {
				echo "Member update successfull";
			}else{
				echo "Failed to update member";
			}
		
	}
 ?>