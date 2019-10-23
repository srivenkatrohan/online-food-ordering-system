<!DOCTYPE html>
<html>
<head>
	<title>Past Orders</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<style type="text/css">
		a{
			color: black;
    		text-decoration: none !important;
		}

	</style>
</head>
<body>
	<div class="navbar">
		<a href="home.php">Home</a>
		<a href="past_orders.php">Past Orders</a>
		<center>
		    <p class="title_app">Online Food Ordering System</p>
		</center>
		<div class="dropdown" style="float:right; padding-right:1px">
			<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Delivery">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<center><p><b>PAST ORDERS</b></p></center>
	<hr><hr>
	<br><br>
	<?php
		include '../connection.php';
		session_start();
		$login_id = $_SESSION['login_id'];
		$order_query = "SELECT * FROM orders WHERE person_id = ".$login_id;
		$order_res = mysqli_query($conn, $order_query);

		while($order_row = mysqli_fetch_assoc($order_res)){
			echo "Order ID: ".$order_row['id'];
			echo "<br>Date: ".$order_row['date'];

			$customer_name_query = "SELECT * FROM users WHERE id=".$order_row['customer_id'];
			$customer_name_res = mysqli_query($conn, $customer_name_query);
			$customer_name_row = mysqli_fetch_assoc($customer_name_res);
			echo  "<br>Customer Name: ".$customer_name_row['name'];
			echo "<br>Customer Contact: ".$customer_name_row['contact'];
			echo "<br>Customer Address: ".$order_row['address'];

			$hotel_name_query = "SELECT * FROM users WHERE id=".$order_row['hotel_id'];
			$hotel_name_res = mysqli_query($conn, $hotel_name_query);
			$hotel_name_row = mysqli_fetch_assoc($hotel_name_res);
			echo  "<br>Hotel Name: ".$hotel_name_row['name'];
			echo "<br>Hotel Contact: ".$hotel_name_row['contact'];
			echo "<br>Hotel Address: ".$hotel_name_row['address'];
			echo "<br>Area: ".$order_row['area'];

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
			echo "</table>";
			echo "<hr>";
		}
	?>

</body>
</html>