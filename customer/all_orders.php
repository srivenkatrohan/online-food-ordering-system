<!DOCTYPE html>
<html>
<head>
	<title>All Orders</title>
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
	<?php
		include '../connection.php';
		session_start();
		$name = $_SESSION['name'];
	?>
	<div class="navbar">
		<a href="home.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn">Orders <i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
			  <a href="all_orders.php?status=active">Active Orders</a>
			  <a href="all_orders.php?status=past">Past Orders</a>
			</div>
	  	</div>
	  	<center>
            <p class="title_app">Online Food Ordering System</p>
        </center>
		<div class="dropdown" style="float:right; padding-right:1px">
			<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Customer">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<div class="content">
	
	
	<?php
		$login_id = $_SESSION['login_id'];
		if($_GET['status'] == "active"){
			echo '<center><p><b>ACTIVE ORDERS</b></p></center>';
			$query = "SELECT * FROM orders WHERE customer_id = $login_id AND status>0";
		}else{
			echo '<center><p><b>PAST ORDERS</b></p></center>';
			$query = "SELECT * FROM orders WHERE customer_id = $login_id AND status<=0";
		}
		echo '<hr><hr><br><br>';
		$res = mysqli_query($conn, $query);
		if(!$res){
			mysqli_error($conn);
		}
		else{
			while($row = mysqli_fetch_assoc($res)){
				echo "<b>Order ID: </b>".$row['id'];
				echo "<br><b>Date: </b>".$row['date'];
				$name_query = "SELECT * FROM users WHERE id=".$row['hotel_id'];
				$name_res = mysqli_query($conn, $name_query);
				$name_row = mysqli_fetch_assoc($name_res);
				$status = $row['status'];
				echo "<br><b>Address: </b>".$row['address'];
				
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
				echo "<b>Area: </b>".$row['area'];
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
						<button><a href="../cancel.php?id='.$row['id'].'&val=cus">Cancel</a></button>
					    </td><td></td></tr>';
					
				}
				echo "</table>";
				echo "<hr>";
			}
		}

	?>
	</div>
</body>
</html>