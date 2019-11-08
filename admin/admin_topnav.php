<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/nav.css">
<div class="navbar">
	<a href="home.php">Home</a>
	<a href="food_menu.php">Food Menu</a>
	<a href="orders.php">Orders</a>
	<div class="dropdown">
		<button class="dropbtn">Users <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="users.php?role=Customer">Customer</a>
		  <a href="users.php?role=Hotel">Hotel</a>
		  <a href="users.php?role=Delivery">Delivery</a>
		</div>
  	</div>
  	<center>
        <p class="title_app">Online Food Ordering System</p>
    </center>
	<div class="dropdown" style="float:right; padding-right:1px">
		<button class="dropbtn"><span>Account <i class="fa fa-caret-down"></i></span>
		</button>
		<div class="dropdown-content">
		  <a href="../edit_profile.php?role=Admin">Edit Profile</a>
		  <a href="../logout.php">Logout</a>
		</div>
  	</div>
</div>