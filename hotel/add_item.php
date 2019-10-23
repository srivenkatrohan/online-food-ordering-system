<?php
	include '../connection.php';
	
	if(isset($_POST['save'])){
		session_start();
		$name = $_SESSION['name'];
		$itemname = $_POST['item_name'];
		$price = $_POST['price'];
		$sql = "INSERT INTO ITEMS(hotel_name, item_name, price) VALUES('$name','$itemname','$price')";
		$query = mysqli_query($conn, $sql);
		header("location:menu.php");
	}
	
?>