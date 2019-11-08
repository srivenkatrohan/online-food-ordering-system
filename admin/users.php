<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
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
	<?php
		include '../connection.php';
		include 'admin_topnav.php';
		$role = $_GET['role'];
		$users_query = "SELECT * FROM users WHERE role='".$role."'";
		$users_res = mysqli_query($conn, $users_query);
		$serial_no = 1;
		echo '<br><table><tr><th>Serial No.</th><th>Name</th><th>Username</th><th>Email</th><th>Address</th><th>Area</th><th>Contact</th></tr>';
		while($users_row = mysqli_fetch_assoc($users_res)){
			echo '<tr><td>'.$serial_no.'</td><td>'.$users_row['name'].'</td><td>'.$users_row['username'].'</td><td>'.$users_row['email'].'</td><td>'.$users_row['address'].'</td><td>'.$users_row['area'].'</td><td>'.$users_row['contact'].'</td><td><button><a href=update.php?id='.$users_row['id'].'>Update</a></button></td><tr>';

			$serial_no += 1;
		}
		echo "</table>";
	?>
</body>
</html>