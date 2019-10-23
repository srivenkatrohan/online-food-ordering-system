<?php
	include '../connection.php';
	$id = $_GET['id'];
	$user_query = "SELECT * FROM users WHERE id=".$id;
	$user_res = mysqli_query($conn, $user_query);
	$user_row = mysqli_fetch_assoc($user_res);
	$user_role = $user_row['role'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../nav.css">
    <link rel="stylesheet" type="text/css" href="../form.css">
    <link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
	<script type="text/javascript">function myFunction() {
		var x = document.getElementById("pass");
		if (x.type === "password") {
	    	x.type = "text";
	    }else{
	    	x.type = "password";
	  	}
	} 
	</script>
</head>
<body>
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
    <br>
	<center>
        <div class="form">
            <form method="post">
                <label>Name</label><input type="text" name="name" readonly="true" value="<?php echo $user_row['name']?>"></br>
                <label>Username</label><input type="text" name="user"  readonly="true" required="true" value="<?php echo $user_row['username']?>"></br>
                <label>Address</label><textarea name="address" rows="3" cols="50" required="true"><?php echo $user_row['address']?></textarea>
                </br>
                <label>Area</label><select name="area">
                        <option name="Ipsum" <?php if($user_row['area']=="Ipsum") echo "selected"?>>Ipsum</option>
                        <option name="Lorem" <?php if($user_row['area']=="Lorem") echo "selected"?>>Lorem</option>
                    </select>
                </br>
                <label>Email</label><input type="text" name="email" value="<?php echo $user_row['email']?>" required="true"></br>
                <label>Contact</label><input type="text" name="contact" value="<?php echo $user_row['contact']?>" required="true"></br>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
        <div class="form">
            <form method="POST">
                <label>Password</label><input type="password" name="pass" id="pass" required="true">
                <button type="submit" name="set_password">Set Password</button>
            </form>
        </div>
    </center>
    <?php
    	if(isset($_POST['update'])){
            $address = $_POST['address'];
            $area = $_POST['area'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
    		$update_query = "UPDATE users SET address='".$address."', area='".$area."', email='".$email."', contact='".$contact."' WHERE id=".$id;
    		$update_res = mysqli_query($conn, $update_query);
    		//echo mysqli_error($conn);
    		
            echo "<script>alert('Updated Details Successfully');
                window.location.href='users.php?role=".$user_role."';
                </script>";
    	}
        if(isset($_POST['set_password'])){
            $password = $_POST['pass'];
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
            $salt = ''; 
          
            for ($i = 0; $i < 10; $i++) { 
                $index = rand(0, strlen($characters) - 1); 
                $salt .= $characters[$index]; 
            } 
            $password .= $salt;
            $hash = hash("SHA256", $password);
            $update_query = "UPDATE users SET password='".$hash."', salt='".$salt."' WHERE id=".$id;
            $update_res = mysqli_query($conn, $update_query);
            if($update_res){
                echo "<script>alert('Updated Password Successfully');
                window.location.href='users.php?role=".$user_role."';
                </script>";
            }
        }
    ?>
</body>
</html>