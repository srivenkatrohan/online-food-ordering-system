<?php
	include 'connection.php';
	session_start();
	if(isset($_SESSION['login_id'])){
		if (isset($_GET['id'])) {
			if ($_GET['val']=='cus') {
				$query = 'UPDATE orders SET status=-1, deleted=1 WHERE id='.$_GET['id'];
				mysqli_query($conn, $query);
				header("location:customer/all_orders.php?status=active");
			}
			elseif ($_GET['val']=='hotel') {
				$query = 'UPDATE orders SET status=-2, deleted=1 WHERE id='.$_GET['id'];
				mysqli_query($conn, $query);
				header("location:hotel/home.php");
			}
		}
	}
	else{
		header("location:login.php");
	}
?>