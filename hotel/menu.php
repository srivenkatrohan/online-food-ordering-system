<?php
	include '../connection.php';
	session_start();
	$name = $_SESSION['name'];
	//echo $name;
?>
<html>
	<head>
		<title>Hotel</title>
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
		<?php include 'hotel_topnav.php'?>
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
					$sql = "SELECT * FROM items WHERE hotel_name='$name'";
					$query = mysqli_query($conn, $sql);
					$i=1;
					while($res=mysqli_fetch_array($query)){
						echo "<tr>
						<td>".$i++."</td>
						<td>".$res['item_name']."</td>
						<td>".$res['price']."</td>";
						if($res['deleted'] == 0){
							echo '<td><button value="Update"><a href="update_item.php?id='.$res['id'].'">Update</a></button>';
							echo '<button value="Delete"><a href="delete_item.php?id='.$res['id'].'">Delete</a></button></td>';
						}else{
							echo '<td><button value="Restore"><a href="restore_item.php?id='.$res['id'].'">Restore</a></button></td>';
						}
						echo "</tr>";
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
