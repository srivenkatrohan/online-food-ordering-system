<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<style type="text/css">
		a{
			color: black;
    		text-decoration: none !important;
		}
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  text-align: left;
		  padding: 8px;
		}

		tr:nth-child(even) {background-color: #f2f2f2;}
	</style>
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
			  <a href="../edit_profile.php">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<br>
	
	<?php
		include '../connection.php';
		$role = $_GET['role'];
		$users_query = "SELECT * FROM users WHERE role='".$role."'";
		$users_res = mysqli_query($conn, $users_query);
		$serial_no = 1;
		echo '<table><tr><th>Serial No.</th><th>Name</th><th>Username</th><th>Email</th><th>Address</th><th>Area</th><th>Contact</th></tr>';
		while($users_row = mysqli_fetch_assoc($users_res)){
			echo '<tr><td>'.$serial_no.'</td><td>'.$users_row['name'].'</td><td>'.$users_row['username'].'</td><td>'.$users_row['email'].'</td><td>'.$users_row['address'].'</td><td>'.$users_row['area'].'</td><td>'.$users_row['contact'].'</td><td><button><a href=update.php?id='.$users_row['id'].'>Update</a></button></td><tr>';

			$serial_no += 1;
		}
		echo "</table>";
	?>
</body>
</html>