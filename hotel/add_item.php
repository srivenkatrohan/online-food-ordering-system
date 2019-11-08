<?php
	include '../connection.php';
	
	if(isset($_POST['save'])){
		session_start();
		if(isset($_POST['hotel'])){
			$name = $_POST['hotel'];
		}
		else{
			$name = $_SESSION['name'];
		}
		$itemname = $_POST['item_name'];
		$price = $_POST['price'];
		$sql = "INSERT INTO items(hotel_name, item_name, price) VALUES('$name','$itemname','$price')";
		$query = mysqli_query($conn, $sql);
		if(isset($_POST['hotel'])){
			echo "<script>alert('Item Added Successfully');window.location='../admin/food_menu.php';</script>";
		}else{
			header("location:menu.php");
		}
	}
	
?>