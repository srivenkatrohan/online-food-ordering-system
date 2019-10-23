<?php
	include 'connection.php';
	
	$table = $_GET['textbox'];
	$query = "select * from ".$table;
	$result = mysqli_query($conn, $query);
	$item = array();

	while($row = mysqli_fetch_assoc($result)){
		$item[] = $row;
	}
	echo json_encode($item);
	
?>