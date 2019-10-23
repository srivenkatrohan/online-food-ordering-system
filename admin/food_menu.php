<!DOCTYPE html>
<html>
<head>
	<title>Manage Menu</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<style type="text/css">
		a{
			color: black;
    		text-decoration: none !important;
		}
		#item_table {
		  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		}

		#item_table td, #item_table th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		#item_table tr:nth-child(even){background-color: #f2f2f2;}

		#item_table tr:hover {background-color: #ddd;}

		#item_table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #FC8019;
		  color: white;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
	</script>
	<script>
		$(document).ready(function(){
			$("#hotel_submit").click(function(){
				var table = "items";
				var hotelname = $('#hotel option:selected').text();
				//alert(table);
				var itemtable = $('#item_table');
				//var formid = $('#form_id');
				itemtable.html("<tr><th>Item</th><th>Price</th><th>Update/Delete</th></tr>");
				$.ajax({
					type: 'GET',
					url: '../get_json.php?textbox='+table,
					success: function(values){
						$.each(JSON.parse(values), function(i, value) {
							if(hotelname == value.hotel_name && value.deleted == 0){
itemtable.append("<tr><td>"+value.item_name+"</td><td>"+value.price+"</td><td><button value=\"Update\"><a href=\"update_item.php?id="+value.id+"\">Update</a></button><button value=\"Delete\"><a href=\"delete_item.php?id="+value.id+"\">Delete</a></button></td></tr>");
							}
						});
					}
				});
				//form_id.append("");
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
			<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Admin">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<br>
	<center>
		<label>Select Hotel:</label>
		<?php 
			include '../connection.php';
			$list=mysqli_query($conn, "select * from users where role='Hotel'"); 
	        
			echo '<select id="hotel" name="hotel">
					<option selected>--Select--</option>';
	        while($row_list=mysqli_fetch_assoc($list)){ 
	           	$name = $row_list['name'];
	        	echo "<OPTION VALUE=\"$name\">".$name."</OPTION>";
	        	
	        }
	        echo "</select>";
		        	
		?>
		    
		
		<button type="button" id="hotel_submit" value="Go" name="hotel_submit">Go</button>
		</br>
		</br>

		<table id="item_table">
			<tr>
				<th>Item</th>
				<th>Price</th>
				<th>Update/Delete</th>
			</tr>
				
		</table>
	</center>
</body>
</html>