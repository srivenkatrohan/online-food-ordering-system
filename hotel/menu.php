<?php
	include '../connection.php';
	session_start();
	$name = $_SESSION['name'];
	//echo $name;
?>
<html>
	<head>
		<title>Hotel</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
		<style type="text/css">
			a{
				color: black;
	    		text-decoration: none !important;
			}
			#hotel_table {
		  		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  		border-collapse: collapse;
			}

			#hotel_table td, #hotel_table th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}

			#hotel_table tr:nth-child(even){background-color: #f2f2f2;}

			#hotel_table tr:hover {background-color: #ddd;}

			#hotel_table th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #FC8019;
			  color: white;
			}
		</style>
	</head>
	<body>
		<div class="navbar">
			<a href="home.php">Home</a>
			<a href="menu.php">Menu</a>
			<a href="home.php?status=1">Past Orders</a>
			<center>
			    <p class="title_app">Online Food Ordering System</p>
			</center>
			<div class="dropdown" style="float:right; padding-right:1px">
				<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
				</button>
				<div class="dropdown-content">
				  <a href="../edit_profile.php?role=Hotel">Edit Profile</a>
				  <a href="../logout.php">Logout</a>
				</div>
		  	</div>
		</div>
		<center>
			<table id="hotel_table" border="2">
				<tr>
					<th>Sno.</th>
					<th>Item Name</th>
					<th>Price</th>
					<th>Action</th>
				</tr>
				<?php
					//ALTER TABLE TABLENAME AUTO_INCREMENT=1;
					$sql = "SELECT id, item_name, price FROM ITEMS WHERE hotel_name='$name' AND deleted=0";
					$query = mysqli_query($conn, $sql);
					$i=1;
					while($res=mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $i; $i++;?></td>
					<td><?php echo $res['item_name']?></td>
					<td><?php echo $res['price']?></td>
					<td><button value="Update"><a href="update_item.php?id=<?php echo $res['id'];?>">Update</a></button>
						<button value="Delete"><a href="delete_item.php?id=<?php echo $res['id'];?>">Delete</a></button></td>
				</tr>
				<?php
					}
				?>
			</table>
			</br>
			<form action="add_item.php" method="POST">
				<label>Item Name:</label><input type="text" name="item_name" placeholder="Enter Item Name" required>
				<label>Price:</label><input type="number" name="price" placeholder="Enter Price" required>
				<input type="submit" name="save" value="Save">
			</form>
		</center>
	</body>
</html>
