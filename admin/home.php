<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
		include 'admin_topnav.php';
		session_start();
		$name = $_SESSION['name'];
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