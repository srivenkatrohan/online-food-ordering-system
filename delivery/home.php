<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
		include 'delivery_topnav.php';
		session_start();
		echo "<center><p><b>ACTIVE ORDER</b></p></center><hr><hr><br><br>";
		$login_id = $_SESSION['login_id'];
		$query = "SELECT * FROM delivery WHERE person_id = $login_id";
		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($res);
		if($row['order_id'] != NULL){
			$order_id = $row['order_id'];
			$order_query = "SELECT * FROM orders WHERE id = ".$row['order_id'];
			$order_res = mysqli_query($conn, $order_query);
			$order_row = mysqli_fetch_assoc($order_res);
			if($row['status'] == 0){
				echo "<script>alert('Order Id: #".$row['order_id']." Received')</script>"; 
			}
			echo "<b>Order ID: </b>".$order_row['id'];
			echo "<br><b>Date: </b>".$order_row['date'];
			$customer_name_query = "SELECT * FROM users WHERE id=".$order_row['customer_id'];
			$customer_name_res = mysqli_query($conn, $customer_name_query);
			$customer_name_row = mysqli_fetch_assoc($customer_name_res);
			$status = $order_row['status'];
			echo  "<br><b>Customer Name: </b>".$customer_name_row['name'];
			echo "<br><b>Customer Contact: </b>".$customer_name_row['contact'];
			echo "<br><b>Customer Address: </b>".$order_row['address'];
			$hotel_name_query = "SELECT * FROM users WHERE id=".$order_row['hotel_id'];
			$hotel_name_res = mysqli_query($conn, $hotel_name_query);
			$hotel_name_row = mysqli_fetch_assoc($hotel_name_res);
			echo  "<br><b>Hotel Name: </b>".$hotel_name_row['name'];
			echo "<br><b>Hotel Contact: </b>".$hotel_name_row['contact'];
			echo "<br><b>Hotel Address: </b>".$hotel_name_row['address'];
			echo "<br><b>Area: </b>".$order_row['area'];

			echo "<br>";
			$query2 = "SELECT * FROM order_details WHERE order_id = ".$order_row['id'];
			$res2 = mysqli_query($conn, $query2);
			$ict = mysqli_num_rows($res2);
			echo "<table cellspacing='5px'><tr><th>Serial No.</th><th>Item Name</th><th>Quantity</th><th>Price</th></tr>";
			$j = 0;
			while($row1 = mysqli_fetch_assoc($res2)) {
				$item_query = "SELECT item_name FROM items WHERE id=".$row1['item_id'];
				$item_res = mysqli_query($conn, $item_query);
				$item_name = mysqli_fetch_assoc($item_res);
				echo "<tr><td>".($j+1)."</td><td>".$item_name['item_name']."</td><td>".$row1['quantity']."</td><td>".$row1['price']."</td>
				      </tr>";
				$j++;
			}
			echo "<tr><td></td><td></td><td></td><td>----</td></tr><tr><td>Total:</td><td></td><td></td><td>".$order_row['total']."</td></tr>";

			if($row['status'] == 0){
				echo '<tr><td></td><td>
						<button><a href="accept.php?id='.$row['order_id'].'">Accept</a></button>
					    </td>';

				echo '<td>
					<button><a href="reject.php?id='.$row['order_id'].'">Reject</a></button>
				    </td></tr>';
			}else{
				echo '<tr><td></td><td>
						<button><a href="delivered.php?id='.$row['order_id'].'">Delivered</a></button>
					    </td>';

				echo '<td>
					<button><a href="cancel.php?id='.$row['order_id'].'">Cancel</a></button>
				    </td></tr>';
			}

			echo "</table>";
		}else{
			echo "<center><b>No Orders to Display</b></center>";
		}

	?>
</body>
</html>