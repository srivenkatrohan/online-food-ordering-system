<!DOCTYPE html>
<html>
<head>
	<title>Place Order</title>
	<style type="text/css">
		table {
		  border-collapse: collapse;
		  
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
		include 'customer_topnav.php';
		session_start();
		$name = $_SESSION['name'];
	?>
	<center>
		<form method="GET">
				<?php
					
					$login_id = $_SESSION['login_id'];
					$address_query = "SELECT * FROM users WHERE id=".$login_id;
					$address_res = mysqli_query($conn, $address_query);
					$address_row = mysqli_fetch_assoc($address_res);
					$address = $address_row['address'];
					$area = $address_row['area'];
					echo 'Address:<input type="text" onfocus="this.value=\'\'" name="addr" value="'.$address.'" required>';
				?>
				</br>
				Area:<select name="area">
                        <option name="Ipsum" <?php if($area == 'Ipsum') echo 'selected'?>>Ipsum</option>
                        <option name="Lorem" <?php if($area == 'Lorem') echo 'selected'?>>Lorem</option>
                    </select>
				</br>
			

			<input type="submit" name="place_order" value="Place Order">
		</form>
	</center>
	<hr>
	<center>
		<p><b>ORDER DETAILS</b></p>
		<table>
			<tr>
				<th>Serial No.</th>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			<?php
				$ct = count($_SESSION['item_name']);
				$tot = 0;
				for ($i=0; $i < $ct; $i++) { 
					echo "<tr><td>".($i+1)."</td>";
					echo "<td>".$_SESSION['item_name'][$i]."</td>";
					echo "<td>".$_SESSION['item_quantity'][$i]."</td>";
					echo "<td>".$_SESSION['item_total'][$i]."</td></tr>";
					$tot += $_SESSION['item_total'][$i];
				}
				echo "<tr><td></td><td></td><td></td><td>----</td></tr>";
				echo "<tr><td></td><td></td><td><b>Amount:</b></td><td><b>".$tot."</b></td></tr>";

				if(isset($_GET['place_order'])){
					//echo $_SESSION['login_id'];
					//echo $_SESSION['hotel_id'];
					$query = "INSERT INTO orders(hotel_id, customer_id, address, area, total, notification) values('".$_SESSION['hotel_id']."','".$_SESSION['login_id']."','".$_GET['addr']."','".$_GET['area']."','".$tot."',1)";
					mysqli_query($conn, $query);

					$order_id = mysqli_insert_id($conn);
					
					for ($i=0; $i < $ct; $i++) { 
						$query = "INSERT INTO order_details(order_id, item_id, quantity, price) values('".$order_id."','".$_SESSION['item_id'][$i]."','".$_SESSION['item_quantity'][$i]."','".$_SESSION['item_total'][$i]."')";
						$res = mysqli_query($conn, $query);
						
					}
					unset($_SESSION['item_id']);
					unset($_SESSION['item_name']);
					unset($_SESSION['item_total']);
					unset($_SESSION['item_quantity']);
					unset($_SESSION['hotel_id']);
					echo "<script>alert('Order Placed Successfully');window.location='all_orders.php?status=active';</script>";
				}

			?>
		</table>
	</center>

</body>
</html>