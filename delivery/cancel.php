<!DOCTYPE html>
<html>
<head>
	<title>Cancel</title>
	<link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
	<?php
		include '../connection.php';
		include 'delivery_topnav.php';
		session_start();
		$login_id = $_SESSION['login_id'];
		if(isset($_POST['cancel'])){
			$desc = $_POST['description'];
			$query = "UPDATE orders SET status=-3, deleted=1, notification=3, description='".$desc."' WHERE id=".$_GET['id'];
			mysqli_query($conn, $query);
			$update_query = "UPDATE delivery SET order_id=NULL, status=0 WHERE person_id=".$login_id;
			$update_res = mysqli_query($conn, $update_query);
			echo "<script>alert('Cancelled Successfully');window.location='home.php';</script>";
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