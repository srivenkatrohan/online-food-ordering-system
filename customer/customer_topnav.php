<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/nav.css">
<div class="navbar">
	<a href="home.php">Home</a>
	<div class="dropdown">
		<button class="dropbtn">Orders <i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-content">
		  <a href="all_orders.php?status=active">Active Orders</a>
		  <a href="all_orders.php?status=past">Past Orders</a>
		</div>
  	</div>
  	<center>
        <p class="title_app">Online Food Ordering System</p>
    </center>
	<div class="dropdown" style="float:right; padding-right:1px">
		<button class="dropbtn">Account <i class="fa fa-caret-down"></i></span>
		</button>
		<div class="dropdown-content">
		  <a href="../edit_profile.php?role=Customer">Edit Profile</a>
		  <a href="../logout.php">Logout</a>
		</div>
  	</div>
</div>