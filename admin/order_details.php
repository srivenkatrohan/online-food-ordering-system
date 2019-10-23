<!DOCTYPE html>
<html>
<head>
	<title>Order Details</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
</head>
<body>
	<div class="navbar">
		<a href="home.php">Home</a>
		<a href="food_menu.php">Food Menu</a>
		<a href="orders.php">Orders</a>
		<div class="dropdown">
			<button class="dropbtn">Users <i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
			  <a href="users.php?role=Customer">Customer</a>
			  <a href="users.php?role=Hotel">Hotel</a>
			  <a href="users.php?role=Delivery">Delivery</a>
			</div>
	  	</div>
	  	<center>
		    <p class="title_app">Online Food Ordering System</p>
		</center>
		<div class="dropdown" style="float:right; padding-right:1px">
			<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Admin">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<center><p><b>ORDER DETAILS</b></p></center>
	<hr><hr><br><br>
	<?php
		include '../connection.php';
		$order_id = $_GET['id'];
		$query = "SELECT * FROM orders WHERE id = $order_id";
		$res = mysqli_query($conn, $query);
		while($row = mysqli_fetch_assoc($res)){
				echo "<b>Order ID:</b> ".$row['id'];
				echo "<br><b>Date: </b>".$row['date'];
				$name_query = "SELECT * FROM users WHERE id=".$row['hotel_id'];
				$name_res = mysqli_query($conn, $name_query);
				$name_row = mysqli_fetch_assoc($name_res);
				$status = $row['status'];
				$customer_name_query = "SELECT * FROM users WHERE id=".$row['customer_id'];
				$customer_name_res = mysqli_query($conn, $customer_name_query);
				$customer_name_row = mysqli_fetch_assoc($customer_name_res);
				echo  "<br><b>Customer Name: </b>".$customer_name_row['name'];
				echo "<br><b>Customer Contact: </b>".$customer_name_row['contact'];
				echo "<br><b>Customer Address: </b>".$row['address'];
				
				if($status == 1 || $status == 0){
					$order_query = "SELECT * FROM delivery WHERE order_id = ".$row['id'];
					$order_res = mysqli_query($conn, $order_query);
					$order_row = mysqli_fetch_assoc($order_res);

					$delivery_person_query = "SELECT * FROM users WHERE id = ".$row['person_id'];
					$delivery_person_res = mysqli_query($conn, $delivery_person_query);
					$delivery_person_row = mysqli_fetch_assoc($delivery_person_res);
					echo "<br><b>Delivery Person Name: </b>".$delivery_person_row['name'];
					echo "<br><b>Delivery Person Contact: </b>".$delivery_person_row['contact'];
				}
				echo  "<br><b>Hotel Name: </b>".$name_row['name'];
				echo "<br><b>Hotel Contact: </b>".$name_row['contact'];
				echo "<br><b>Hotel Address: </b>".$name_row['address'];
				echo "<br><b>Hotel: </b>".$name_row['name'];
				echo "<br><b>Area: </b>".$row['area'];
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
				}else{
					echo "Cancelled by Hotel";
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
				
				echo "</table>";
				echo "<hr>";
			}
	?>

</body>
</html>