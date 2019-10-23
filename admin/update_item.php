<?php 
	include '../connection.php';
	session_start();
	$name = $_SESSION['name'];
	
	
	if (isset($_POST['update_save'])) {
		$itemname = $_POST['item_name'];
		$price = $_POST['price'];
		$id = $_GET['id'];
		echo $id;
		$sql = "UPDATE ITEMS SET item_name='$itemname', price='$price' WHERE id='$id'";
		$query = mysqli_query($conn, $sql);
		header("location:food_menu.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../nav.css">
    <link rel="stylesheet" type="text/css" href="../form.css">
    <link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
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
    <div class="page">
        <div class="form">
        	<form method="post">
        		<label>Item Name</label>
        		<input type="text" name="item_name" placeholder="Enter Item Name">
        		<label>Price</label>
        		<input type="text" name="price" placeholder="Enter Price">
                <button type="submit" name="update_save">Save</button>
        	</form>
        </div>
    </div>
</body>
</html>