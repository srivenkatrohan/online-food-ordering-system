<?php
	include '../connection.php';
	session_start();
	if(isset($_SESSION['login_id'])){
		if (isset($_GET['id'])) {
			$query = 'UPDATE orders SET status=2 WHERE id='.$_GET['id'];
			mysqli_query($conn, $query);
			header("location:home.php");
			
		}
	}
	else{
		header("location:../login.php");
	}
?>