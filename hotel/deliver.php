<?php
	include '../connection.php';
	if (isset($_GET['id'])) {
		$order_id = $_GET['id'];
		$order_query = 'SELECT * FROM orders  WHERE id='.$order_id;
		$order_res = mysqli_query($conn, $order_query);
		$order_row = mysqli_fetch_assoc($order_res);

		$delivery_query = 'SELECT * FROM delivery WHERE order_id IS NULL';
		$delivery_res = mysqli_query($conn, $delivery_query);
		$flag = 0;
		while ($delivery_row = mysqli_fetch_assoc($delivery_res)) {
			$delivery_person_query = 'SELECT * FROM users WHERE id='.$delivery_row['person_id'];
			$delivery_person_res = mysqli_query($conn, $delivery_person_query);
			$delivery_person_row = mysqli_fetch_assoc($delivery_person_res);
			if($delivery_person_row['area'] == $order_row['area']){
				$flag = 1;
				$update_query = "UPDATE delivery SET order_id = ".$order_id." WHERE person_id = ".$delivery_row['person_id'];
				mysqli_query($conn, $update_query);
				//$query = 'UPDATE orders SET status=1 WHERE id='.$order_id;
				//mysqli_query($conn, $query);
				break;
			}
		}
		if($flag == 0){
			header("location:home.php?flag=1");
		}else{
			header("location:home.php");
		}
		
		

	}
?>