<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<style type="text/css">
		.title {
            color: #FC8019;
            font-family: 'Italianno', cursive;
            font-size: 30px;
            margin: 0px;
            padding: 0px;
            width: 250px;
            height: 0px;
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
				itemtable.html("<tr><th>Item</th><th>Price</th><th>Quantity</th></tr>");
				$.ajax({
					type: 'GET',
					url: '../get_json.php?textbox='+table,
					success: function(values){
						$.each(JSON.parse(values), function(i, value) {
							if(hotelname == value.hotel_name && value.deleted == 0){
								itemtable.append("<tr><td>"+value.item_name+"</td><td>"+value.price+"</td><td><input type=\"number\" name=\""+value.id+"\"></td></tr>");
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
	<?php
		include '../connection.php';
		session_start();
		$name = $_SESSION['name'];
	?>
	<div class="navbar">
		<a href="home.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn">Orders <i class="fa fa-caret-down"></i>
			</button>
			<div class="dropdown-content">
			  <a href="all_orders.php?status=active">Active Orders</a>
			  <a href="all_orders.php?status=past">Past Orders</a>
			</div>
	  	</div>
	  	<center>
            <p class="title">Online Food Ordering System</p>
        </center>
		<div class="dropdown" style="float:right; padding-right:1px">
			<button class="dropbtn">Account <i class="fa fa-caret-down"></i></span>
			</button>
			<div class="dropdown-content">
			  <a href="../edit_profile.php?role=Customer">Edit Profile</a>
			  <a href="../logout.php">Logout</a>
			</div>
	  	</div>
	</div>
	<br>
	<center>
		<form method="get">
		<label>Select Hotel:</label>
			<?php 
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
					<th>Quantity</th>
				</tr>
				
			</table>
			<button type="submit" name="submit">Place</button>
		</form>

	</center>
</body>
</html>

<?php
	if(isset($_GET['submit'])){
		//echo $_POST['hotel'];
		
		$hotel_name = $_GET['hotel'];
		$query = "select id from users where name='$hotel_name'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$_SESSION['hotel_id'] = $row['id'];
		$query = "select * from items where hotel_name='$hotel_name' and deleted = 0";
		$result = mysqli_query($conn, $query);
		//echo $result;
		$tot = 0;
		$item_id = array();
		$item_name = array();
		$item_quantity = array();
		$item_total = array();
		while($row = mysqli_fetch_row($result)){
			//echo $_GET[$row[0]];
			$quant = $_GET[$row[0]];
			if($quant != 0){
				array_push($item_id, $row[0]);
				array_push($item_name, $row[2]);
				array_push($item_quantity, $quant);
				array_push($item_total, $quant * $row[3]);
				
			}
		}
		$_SESSION['item_id'] = $item_id;
		$_SESSION["item_name"] = $item_name;
		$_SESSION["item_quantity"] = $item_quantity;
		$_SESSION["item_total"] = $item_total;
		if(!empty($item_id)){
			header("location:place_order.php");
		}else{
			echo '<script>alert("Enter Quantity")</script>';
		}
	}
	
?>