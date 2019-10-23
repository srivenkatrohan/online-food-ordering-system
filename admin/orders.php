<!DOCTYPE html>
<html>
<head>
	<title>Orders</title>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
	<script>
		$(document).ready(function(){
			$("#search").click(function(){
				var table = "orders";
				var itemtable = $('#itemtable');
				var order_id = $('#order_id').val();
				var hotel_name;
				var customer_name;
				var person_name;
				itemtable.html("<tr><th>Order ID</th><th>Hotel Name</th><th>Customer Name</th><th>Delivery Person</th><th>Date</th><th>Total</th></tr>");
				$.ajax({
					type: 'GET',
					url: '../get_json.php?textbox=orders',
					success: function(values){
						var exist = 0;
						$.each(JSON.parse(values), function(i, value) {
							if(order_id == value.id){
								exist = 1;
								$.ajax({
									type: 'GET',
									url: '../get_json.php?textbox=users',
									success: function(user_values){
										//alert(hotel_name);
										$.each(JSON.parse(user_values), function(j, user_value) {
											
											if(value.hotel_id == user_value.id){
												hotel_name = user_value.name;
												
											}
											if(value.customer_id == user_value.id){
												customer_name = user_value.name;
											}
											if(value.person_id == user_value.id){
												person_name = user_value.name;
											}
											
										});
										
										if(typeof person_name === "undefined"){
											itemtable.append("<tr><td>#"+order_id+"</td><td>"+hotel_name+"</td><td>"+customer_name+"</td><td>Not Assigned</td><td>"+value.date+"</td><td>"+value.total+"</td><td><button><a href=\"order_details.php?id="+order_id+"\">View Details</a></button></td></tr>");
											
										}
										else{
											itemtable.append("<tr><td>"+order_id+"</td><td>"+hotel_name+"</td><td>"+customer_name+"</td><td>"+person_name+"</td><td>"+value.date+"</td><td>"+value.total+"</td><td><button><a href=\"order_details.php?id="+order_id+"\">View Details</a></button></td></tr>");
										}
										
									}
								});
							}
						});
						if(exist == 0){
							alert("No Records Found");
						}
					}
				});
			});
		});
	</script>
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
			<button class="dropbtn">Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Admin">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<br>
	<?php
		include '../connection.php';		
	?>
	<center>
		<label>Search:</label><input type="number" name="order_id" id="order_id" placeholder="Enter Order ID" required>
		<button type="submit" name="search" id="search"><img src="../images/search.png" height="10px" width="10px"></button>
		<button><a href="orders.php">&#8635;</a></button>
	</center>
	<br>
	<table id="itemtable">
		<tr>
			<th>Order ID</th>
			<th>Hotel Name</th>
			<th>Customer Name</th>
			<th>Delivery Person</th>
			<th>Date</th>
			<th>Total</th>
		</tr>
		<?php
			$order_query = "SELECT * FROM orders";
			$order_res = mysqli_query($conn, $order_query);

			while($order_row = mysqli_fetch_assoc($order_res)){
				$hotel_query = "SELECT * FROM users WHERE id=".$order_row['hotel_id'];
				$hotel_res = mysqli_query($conn, $hotel_query);
				$hotel_row = mysqli_fetch_assoc($hotel_res);

				$customer_query = "SELECT * FROM users WHERE id=".$order_row['customer_id'];
				$customer_res = mysqli_query($conn, $customer_query);
				$customer_row = mysqli_fetch_assoc($customer_res);
				$assigned = 0;
				if($order_row['person_id'] != NULL){
					$delivery_query = "SELECT * FROM users WHERE id=".$order_row['person_id'];
					$delivery_res = mysqli_query($conn, $delivery_query);
					$delivery_row = mysqli_fetch_assoc($delivery_res);
					$assigned = 1;
				}

				echo '<tr><td>#'.$order_row['id'].'</td><td>'.$hotel_row['name'].'</td><td>'.$customer_row['name'].'</td>';
				if($assigned==0){
					echo '<td>Not Assigned</td>';
				}else{
					echo '<td>'.$delivery_row['name'].'</td>';
				}
				echo '<td>'.$order_row['date'].'</td><td>'.$order_row['total'].'</td><td><button><a href="order_details.php?id='.$order_row['id'].'">View Details</a></button></td></tr>';
			}

		?>	
	</table>
</body>
</html>