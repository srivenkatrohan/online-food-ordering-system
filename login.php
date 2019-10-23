<?php
    include 'connection.php';
    session_start();
    if(isset($_POST['submit'])){
        $uname = $_POST['user'];
        $pass = $_POST['pass'];

        $user_query = "SELECT * FROM users WHERE username='$uname'";
        $user_res = mysqli_query($conn, $user_query);
        $user_row = mysqli_fetch_assoc($user_res);
        
        $pass .= $user_row['salt'];
        $hash = hash("SHA256", $pass);

        if($user_row['password'] == $hash){
            $_SESSION['login_id'] = $user_row['id'];
            $_SESSION['name'] = $user_row['name'];
            $role = $user_row['role'];
            $_SESSION['user'] = $uname;
            if($role == 'Admin'){
                header("location:admin/home.php");
            }
            else if($role == 'Hotel'){
                header("location:hotel/home.php");
            }
            else if($role == 'Delivery'){
                header("location:delivery/home.php");
            }
            else{
                header("location:customer/home.php");
            }
        }
        else{
            $message = "Invalid Credentials";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/form.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <style type="text/css">
            .title {
                color: #FC8019;
                font-family: 'Italianno', cursive;
                font-size: 30px;
                margin: 10px;
            }
        </style>
        <script type="text/javascript">
            $('.message a').click(function(){
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            });
        </script>
    </head>
    <body>
        <div class="navbar">
            <center>
            <p class="title">Online Food Ordering System</p>
            </center>
        </div>
        <br>
        <div class="page">
          <div class="form">
            <form class="login-form" method="POST">
              <input type="text" placeholder="username" name="user" required="true"/>
              <input type="password" placeholder="password" name="pass" required="true"/>
              <button type="submit" value="Login" name="submit">login</button>
              <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
          </div>
        </div>
    </body>
</html>
