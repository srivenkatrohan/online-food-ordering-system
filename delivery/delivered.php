<?php
	include '../connection.php';
	session_start();
	$login_id = $_SESSION['login_id'];
	$order_id = $_GET['id'];
	$update_query = "UPDATE delivery SET order_id=NULL, status=0 WHERE person_id=".$login_id;
	$update_res = mysqli_query($conn, $update_query);
	$update_query = 'UPDATE orders SET status=0, notification=3 WHERE id='.$order_id;
	$update_res = mysqli_query($conn, $update_query);
	header("location:home.php");
?>