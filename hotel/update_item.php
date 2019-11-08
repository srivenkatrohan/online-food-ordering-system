<?php 
	include '../connection.php';
	session_start();
	$name = $_SESSION['name'];
	
	
	if (isset($_POST['update_save'])) {
		$itemname = $_POST['item_name'];
		$price = $_POST['price'];
		$id = $_GET['id'];
		echo $id;
		$sql = "UPDATE ITEMS SET item_name='$itemname', price='$price' WHERE id='$id'";
		$query = mysqli_query($conn, $sql);
		header("location:menu.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Item</title>
	<link rel="stylesheet" type="text/css" href="../css/form.css">
</head>
<body>
	<?php 
		include 'hotel_topnav.php';
		$item_query = "SELECT * FROM items WHERE id=".$_GET['id'];
		$item_res = mysqli_query($conn, $item_query);
		$item_row = mysqli_fetch_assoc($item_res);
	?>
	<br>
	<div class="page">
    	<div class="form">
			<form method="post">
				<label>Item Name</label>
				<input type="text" name="item_name" value="<?php echo $item_row['item_name']?>" required>
				<label>Price</label>
				<input type="text" name="price" value="<?php echo $item_row['price']?>" required>
				<button type="submit" name="update_save">Save</button>
			</form>
		</div>
	</div>
</body>
</html>