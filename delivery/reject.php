<?php
	include '../connection.php';
	session_start();
	$login_id = $_SESSION['login_id'];
	$update_query = "UPDATE delivery SET order_id=NULL WHERE person_id=".$login_id;
	$update_res = mysqli_query($conn, $update_query);

	$flag = 0;
	$ct = 0;
	while($flag!=1 && $ct!=2){
		$delivery_query = "SELECT * FROM delivery WHERE order_id IS NULL AND person_id>".$login_id;
		$delivery_res = mysqli_query($conn, $delivery_query);
		$query_count = mysqli_num_rows($delivery_res);
		
		if($query_count == 0){
			$delivery_query = "SELECT * FROM delivery WHERE order_id IS NULL";
			$delivery_res = mysqli_query($conn, $delivery_query);
		}
		

		$order_id = $_GET['id'];
		$order_query = 'SELECT * FROM orders  WHERE id='.$order_id;
		$order_res = mysqli_query($conn, $order_query);
		$order_row = mysqli_fetch_assoc($order_res);

		
		
		while ($delivery_row = mysqli_fetch_assoc($delivery_res)) {
			$delivery_person_query = 'SELECT * FROM users WHERE id='.$delivery_row['person_id'];
			$delivery_person_res = mysqli_query($conn, $delivery_person_query);
			$delivery_person_row = mysqli_fetch_assoc($delivery_person_res);

			$hotel_query = 'SELECT * FROM users WHERE id='.$order_row['hotel_id'];
			$hotel_res = mysqli_query($conn, $hotel_query);
			$hotel_row = mysqli_fetch_assoc($hotel_res);

			if($delivery_person_row['area'] == $hotel_row['area']){
				$flag = 1;
				$update_query = "UPDATE delivery SET order_id = ".$order_id." WHERE person_id = ".$delivery_row['person_id'];
				mysqli_query($conn, $update_query);
				break;
			}
			$login_id = $delivery_row['person_id'];
		}
		$ct++;
	}

	header("location:home.php");

?>