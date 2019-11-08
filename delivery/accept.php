<?php
	include '../connection.php';
	session_start();
	$login_id = $_SESSION['login_id'];
	$order_id = $_GET['id'];
	$update_query = "UPDATE delivery SET status=1 WHERE person_id=".$login_id;
	$update_res = mysqli_query($conn, $update_query);
	$update_query = 'UPDATE orders SET person_id='.$login_id.', status=1, notification=3 WHERE id='.$order_id;
	$update_res = mysqli_query($conn, $update_query);
	header("location:home.php");
?>