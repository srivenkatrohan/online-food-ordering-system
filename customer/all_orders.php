<!DOCTYPE html>
<html>
<head>
	<title>All Orders</title>
	<style type="text/css">
		a{
			color: black;
    		text-decoration: none !important;
		}

	</style>
</head>
<body>
	<?php
		include '../connection.php';
		include 'customer_topnav.php';
		session_start();
		$name = $_SESSION['name'];
		$login_id = $_SESSION['login_id'];
		if($_GET['status'] == "active"){
			echo '<center><p><b>ACTIVE ORDERS</b></p></center>';
			$query = "SELECT * FROM orders WHERE customer_id = $login_id AND (status>0 OR notification = 1 OR notification = 3 OR notification = -4)";
		}else{
			echo '<center><p><b>PAST ORDERS</b></p></center>';
			$query = "SELECT * FROM orders WHERE customer_id = $login_id AND status<=0";
		}
		echo '<hr><hr><br><br>';
		$res = mysqli_query($conn, $query);
		if(mysqli_num_rows($res) == 0){
			echo "<center><b>No Orders to Display</b></center>";
		}
		else{
			while($row = mysqli_fetch_assoc($res)){
				$update_query;
				if($row['notification'] == 1 && ($row['status'] == 2 || $row['status'] == -2)){
					$update_query = "UPDATE orders SET notification = 0 WHERE id = ".$row['id'];
					if($row['status'] == 2){
						echo "<script>alert('Order ID: #".$row['id']." In The Kitchen')</script>";
					}else{
						echo "<script>alert('Order ID: #".$row['id']." Cancelled By Hotel')</script>";
					}
				}
				else if(($row['status'] == 1 || $row['status'] == 0) && ($row['notification'] == 3 || $row['notification'] == -4)){
					if($row['notification'] == 3){
						$update_query = "UPDATE orders SET notification = 4 WHERE id = ".$row['id'];
					}else{
						$update_query = "UPDATE orders SET notification = -5 WHERE id = ".$row['id'];
					}
					if($row['status'] == 0){
						echo "<script>alert('Order ID: #".$row['id']." Delivered Successfully')</script>";
					}else{
						echo "<script>alert('Order ID: #".$row['id']." Yet To Be Delivered')</script>";
					}
				}
				if(isset($update_query)){
					mysqli_query($conn, $update_query);
				}
				echo "<b>Order ID: </b>".$row['id'];
				echo "<br><b>Date: </b>".$row['date'];
				$name_query = "SELECT * FROM users WHERE id=".$row['hotel_id'];
				$name_res = mysqli_query($conn, $name_query);
				$name_row = mysqli_fetch_assoc($name_res);
				$status = $row['status'];
				echo "<br><b>Address: </b>".$row['address'];
				echo "<br><b>Area: </b>".$row['area'];
				
				if($status == 1){
					$order_query = "SELECT * FROM delivery WHERE order_id = ".$row['id'];
					$order_res = mysqli_query($conn, $order_query);
					$order_row = mysqli_fetch_assoc($order_res);

					$delivery_person_query = "SELECT * FROM users WHERE id = ".$order_row['person_id'];
					$delivery_person_res = mysqli_query($conn, $delivery_person_query);
					$delivery_person_row = mysqli_fetch_assoc($delivery_person_res);
					echo "<br><b>Delivery Person Name: </b>".$delivery_person_row['name'];
					echo "<br><b>Delivery Person Contact: </b>".$delivery_person_row['contact'];
				}
				echo "<br><b>Hotel: </b>".$name_row['name'];
				echo "<br><b>Hotel Address: </b>".$name_row['address'];
				echo "<br><b>Hotel Area: </b>".$name_row['area'];
				echo "<br><b>Status: </b>";
				if($status == 3){
					echo "Waiting";
				}
				else if($status == 2){
					echo "In The Kitchen";
				}else if($status == 1){
					echo "Yet to be Delivered";
				}else if($status == 0){
					echo "Delivered Successfully";
				}else if($status == -1){
					echo "Cancelled by Customer";
					echo "<br><b>Description: </b>".$row['description'];
				}else{
					echo "Cancelled by Hotel";
					echo "<br><b>Description: </b>".$row['description'];
				}
				echo "<br>";
				$query2 = "SELECT * FROM order_details WHERE order_id = ".$row['id'];
				$res2 = mysqli_query($conn, $query2);
				$ict = mysqli_num_rows($res2);
				echo "<table cellspacing='5px'><tr><th>Serial no.</th><th>Item Name</th><th>Quantity</th><th>Price</th></tr>";
				$j = 0;
				while($row1 = mysqli_fetch_assoc($res2)) {
					$item_query = "SELECT item_name FROM items WHERE id=".$row1['item_id'];
					$item_res = mysqli_query($conn, $item_query);
					$item_name = mysqli_fetch_assoc($item_res);
					echo "<tr><td>".($j+1)."</td><td>".$item_name['item_name']."</td><td>".$row1['quantity']."</td><td>".$row1['price']."</td>
					      </tr>";
					$j++;
				}
				echo "<tr><td></td><td></td><td></td><td>----</td></tr><tr><td>Total:</td><td></td><td></td><td>".$row['total']."</td></tr>";
				if($status == 2 || $status == 3){
					echo '<tr><td></td><td>
						<button><a href="cancel.php?id='.$row['id'].'&val=cus">Cancel</a></button>
					    </td><td></td></tr>';
					
				}
				echo "</table>";
				echo "<hr>";
			}
		}

	?>
</body>
</html>