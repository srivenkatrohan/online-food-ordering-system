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
    <link rel="stylesheet" type="text/css" href="../css/form.css">
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
    <?php include 'admin_topnav.php';?>
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