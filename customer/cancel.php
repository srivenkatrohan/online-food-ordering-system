<!DOCTYPE html>
<html>
<head>
	<title>Cancel</title>
	<link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
	<?php
		include '../connection.php';
		include 'customer_topnav.php';
		session_start();
		if(isset($_POST['cancel'])){
			$desc = $_POST['description'];
			$query = "UPDATE orders SET status=-1, deleted=1, notification=1 ,description='".$desc."' WHERE id=".$_GET['id'];
			mysqli_query($conn, $query);
			echo "<script>alert('Cancelled Successfully');window.location='all_orders.php?status=active';</script>";
		}
	?>
	<br>
	<div class="form">
		<form method="POST">
			<textarea placeholder="Enter Description" name="description" required="true"></textarea>
			<button type="submit" name="cancel">Cancel</button>
		</form>
	</div>
</body>
</html>