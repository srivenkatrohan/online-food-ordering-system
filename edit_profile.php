<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<style type="text/css">
	</style>
	<script type="text/javascript">
		function myFunction(textbox){
			document.getElementById(textbox).value = "";
		}
		

		function validatePassword(){
			var password = document.getElementById("new_password")
	  , confirm_password = document.getElementById("confirm_password");
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
		    confirm_password.setCustomValidity('');
		  }
		}

	</script>
</head>
<body>
	<?php
		include 'connection.php';
		session_start();
		if(isset($_SESSION['login_id'])){
			$role = $_GET['role'];
			$details_query = "SELECT * FROM users WHERE id=".$_SESSION['login_id'];
			$details_res = mysqli_query($conn, $details_query);
			$details_row = mysqli_fetch_assoc($details_res);
			if($role == 'Customer'){
				echo '
				<div class="navbar">
					<a href="customer/home.php">Home</a>
					<div class="dropdown">
						<button class="dropbtn">Orders <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content">
						  <a href="customer/all_orders.php?status=active">Active Orders</a>
						  <a href="customer/all_orders.php?status=past">Past Orders</a>
						</div>
				  	</div>
				  	<center>
					    <p class="title_app">Online Food Ordering System</p>
					</center>
					<div class="dropdown" style="float:right; padding-right:1px">
						<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
						</button>
						<div class="dropdown-content">
						  <a href="edit_profile.php?role=Customer">Edit Profile</a>
						  <a href="logout.php">Logout</a>
						</div>
				  	</div>
				</div>';		
			}else if($role == 'Hotel'){
				echo '
				<div class="navbar">
					<a href="hotel/home.php">Home</a>
					<a href="hotel/menu.php">Menu</a>
					<a href="hotel/home.php?status=1">Past Orders</a>
					<center>
					    <p class="title_app">Online Food Ordering System</p>
					</center>
					<div class="dropdown" style="float:right; padding-right:1px">
						<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
						</button>
						<div class="dropdown-content">
						  <a href="edit_profile.php?role=Hotel">Edit Profile</a>
						  <a href="logout.php">Logout</a>
						</div>
				  	</div>
				</div>';
			}elseif ($role == 'Delivery') {
				echo '
				<div class="navbar">
					<a href="delivery/home.php">Home</a>
					<a href="delivery/past_orders.php">Past Orders</a>
					<center>
						<p class="title_app">Online Food Ordering System</p>
					</center>
					<div class="dropdown" style="float:right; padding-right:1px">
						<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
						</button>
						<div class="dropdown-content">
						  <a href="edit_profile.php?role=Delivery">Edit Profile</a>
						  <a href="logout.php">Logout</a>
						</div>
				  	</div>
				</div>';
			}else if($role == 'Admin'){
				echo '
				<div class="navbar">
					<a href="admin/home.php">Home</a>
					<a href="admin/food_menu.php">Food Menu</a>
					<a href="admin/orders.php">Orders</a>
					<div class="dropdown">
						<button class="dropbtn">Users <i class="fa fa-caret-down"></i>
						</button>
						<div class="dropdown-content">
						  <a href="admin/users.php?role=Customer">Customer</a>
						  <a href="admin/users.php?role=Hotel">Hotel</a>
						  <a href="admin/users.php?role=Delivery">Delivery</a>
						</div>
				  	</div>
				  	<center>
					    <p class="title_app">Online Food Ordering System</p>
					</center>
					<div class="dropdown" style="float:right; padding-right:1px">
						<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
						</button>
						<div class="dropdown-content">
						  <a href="edit_profile.php">Edit Profile</a>
						  <a href="logout.php">Logout</a>
						</div>
				  	</div>
				</div>';
			}
		}
	?>
	<br>
	<center>

    	<div class="form">
			<form method="POST">
				<label>Name</label><input type="text" name="name" readonly="true" value="<?php echo $details_row['name']?>">
				<br>
				<label>Username</label><input type="text" name="username" readonly="true" value="<?php echo $details_row['username']?>">
				<br>
				<label>Address</label><textarea name="address" id="address" required="true"><?php echo $details_row['address']?></textarea>
				<br>
				<label>Area</label><select name="area">
		                    <option name="Ipsum" <?php if($details_row['area']=="Ipsum") echo "selected"?>>Ipsum</option>
		                    <option name="Lorem" <?php if($details_row['area']=="Lorem") echo "selected"?>>Lorem</option>
		                </select>
		        </br>
				<label>Contact</label><input type="text" required="true" name="contact" id="contact" value="<?php echo $details_row['contact']?>">
				<br>
				<label>Email</label><input type="text" required="true" name="email" id="email" value="<?php echo $details_row['email']?>">
				<br>
				<button type="submit" name="save">Save</button>
			</form>
		</div>
		
        <div class="form">
			<form method="POST">
				<label>Old Password</label><input type="password" name="old_password" required="true"><br>
				<label>New Password</label><input type="password" name="new_password" id="new_password" required><br>
	        	<label>Confirm Password</label><input type="password" id="confirm_password" required><br>
	        	<button type="submit" name="change_password" onclick="validatePassword()">Change Password</button>
			</form>
		</div>

	</center>
	<?php
		if(isset($_POST['save'])){
			$update_query = "UPDATE users SET address='".$_POST['address']."',area='".$_POST['area']."', contact='".$_POST['contact']."', email='".$_POST['email']."' WHERE id=".$_SESSION['login_id'];
			$update_res = mysqli_query($conn, $update_query);
			if($update_res){

				echo '<script>alert("Updated Details Successfully")</script>';
			}
		}
		if(isset($_POST['change_password'])){
			$pass = $_POST['old_password'];
			$user_query = "SELECT * FROM users WHERE id=".$_SESSION['login_id'];
	        $user_res = mysqli_query($conn, $user_query);
	        $user_row = mysqli_fetch_assoc($user_res);
	        
	        $pass .= $user_row['salt'];
	        $hash = hash("SHA256", $pass);

	        if($user_row['password'] == $hash){
	        	$password = $_POST['new_password'];
	        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	            $salt = ''; 
	          
	            for ($i = 0; $i < 10; $i++) { 
	                $index = rand(0, strlen($characters) - 1); 
	                $salt .= $characters[$index]; 
	            } 
	            $password .= $salt;
	            $hash = hash("SHA256", $password);
	            $update_query = "UPDATE users SET password='".$hash."', salt='".$salt."' WHERE id=".$_SESSION['login_id'];
				$update_res = mysqli_query($conn, $update_query);
				if($update_res){
					echo '<script>alert("Updated Password Successfully")</script>';
				}
	        }else{
	        	echo '<script>alert("Incorrect Password")</script>';
	        }
		}
	?>
</body>
</html>