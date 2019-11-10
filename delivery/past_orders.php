<!DOCTYPE html>
<html>
<head>
	<title>Past Orders</title>
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
		echo "<center><p><b>PAST ORDERS</b></p></center><hr><hr><br><br>";
		$login_id = $_SESSION['login_id'];
		$order_query = "SELECT * FROM orders WHERE person_id = ".$login_id." AND (status=0 OR status=-3)";
		$order_res = mysqli_query($conn, $order_query);
		if(mysqli_num_rows($order_res) == 0){
			echo "<center><b>No Orders to Display</b></center>";
		}else{
			while($order_row = mysqli_fetch_assoc($order_res)){
				echo "<b>Order ID: </b>".$order_row['id'];
				echo "<br><b>Date: </b>".$order_row['date'];

				$customer_name_query = "SELECT * FROM users WHERE id=".$order_row['customer_id'];
				$customer_name_res = mysqli_query($conn, $customer_name_query);
				$customer_name_row = mysqli_fetch_assoc($customer_name_res);
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
				echo "<b>Status: </b>";
				if($order_row['status'] == 0){
					echo "Delivered";
				}else{
					echo "Not Delivered";
					echo "<br><b>Description: </b>".$order_row['description'];
				}
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
				echo "</table>";
				echo "<hr>";
			}
		}
	?>

</body>
</html>