<?php
	include '../connection.php';
	$id = $_GET['id'];
	echo $id;
	$sql = "UPDATE items SET deleted=0 WHERE id=$id";
	mysqli_query($conn, $sql);


	header("location:menu.php");
?>