<!DOCTYPE html>
<html>
<head>
	<title>Manage Menu</title>
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
							if(hotelname == value.hotel_name){
								if(value.deleted == 0){
itemtable.append("<tr><td>"+value.item_name+"</td><td>"+value.price+"</td><td><button value=\"Update\"><a href=\"update_item.php?id="+value.id+"\">Update</a></button><button value=\"Delete\"><a href=\"delete_item.php?id="+value.id+"\">Delete</a></button></td></tr>");
								}
								else{
itemtable.append("<tr><td>"+value.item_name+"</td><td>"+value.price+"</td><td><button value=\"Update\"><a href=\"restore_item.php?id="+value.id+"\">Restore</a></button></td></tr>");
								}
							}
						});
					}
				});
				$('#add_item_div').html('<br><label>Item Name:</label><input type="text" name="item_name" placeholder="Enter Item Name" required><label>Price:</label><input type="number" name="price" placeholder="Enter Price" required><input type="submit" name="save" value="Save">');
			});
		});
	</script>
</head>
<body>
	<?php include 'admin_topnav.php';?>
	<br>
	<center>
		<form action="../hotel/add_item.php" method="POST" id="form_id">
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
					
			</table>
			<div id="add_item_div">
				
			</div>
			
		</form>
	</center>
</body>
</html>