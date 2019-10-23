<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<style type="text/css">
		
		.grid-container {
		  display: grid;
		  grid-template-columns: auto auto auto;
		  background-color: #000000;
		  padding: 10px;
		  margin: 15px;
		  margin-left: 10%;
		  margin-right: 10%;
		}
		.grid-item {
		  background-color: rgba(255, 255, 255, 0.8);
		  border: 1px solid rgba(0, 0, 0, 0.8);
		  padding: 30%;
		  font-size: 20px;
		  text-align: center;

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
	<?php
		$query = "SELECT * FROM orders";
		$res = mysqli_query($conn, $query);
		$total_orders = mysqli_num_rows($res);
		$query = "SELECT * FROM orders WHERE status=2";
		$res = mysqli_query($conn, $query);
		$in_the_kitchen = mysqli_num_rows($res);
		$query = "SELECT * FROM orders WHERE status=1";
		$res = mysqli_query($conn, $query);
		$yet_to_be_delivered = mysqli_num_rows($res);
		$query = "SELECT * FROM orders WHERE status=0";
		$res = mysqli_query($conn, $query);
		$delivered_successfully = mysqli_num_rows($res);
		$query = "SELECT * FROM orders WHERE status<0";
		$res = mysqli_query($conn, $query);
		$cancelled = mysqli_num_rows($res);
		$query = "SELECT * FROM users WHERE role='Customer' OR role='Delivery' OR role='Hotel'";
		$res = mysqli_query($conn, $query);
		$total_users = mysqli_num_rows($res);
	?>
	<div class="grid-container">
		<div class="grid-item">Total Orders: <?php echo $total_orders ?></div>
		<div class="grid-item">Orders In The Kitchen: <?php echo $in_the_kitchen ?></div>
		<div class="grid-item">Orders Yet To Be Delivered: <?php echo $yet_to_be_delivered ?></div>  
		<div class="grid-item">Orders Delivered Successfully: <?php echo $delivered_successfully ?></div>
		<div class="grid-item">Cancelled Orders: <?php echo $cancelled ?></div>
		<div class="grid-item">Total Users: <?php echo $total_users ?></div> 
	</div>

</body>
</html>