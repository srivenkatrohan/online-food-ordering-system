<?php
    include 'connection.php';

    if(isset($_POST['submit'])){
        $check_uname_query = "SELECT * FROM users WHERE username='".$_POST['user']."'";
        $check_uname_res = mysqli_query($conn, $check_uname_query);
        if(mysqli_num_rows($check_uname_res) == 0){
            $role = $_POST['role'];
            $area = $_POST['area'];
            if($area!='Select Area' && $role != 'Select Role'){
                $name = $_POST['name'];
                $username = $_POST['user'];
                $password = $_POST['pass'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
                $salt = ''; 
              
                for ($i = 0; $i < 10; $i++) { 
                    $index = rand(0, strlen($characters) - 1); 
                    $salt .= $characters[$index]; 
                } 
                $password .= $salt;
                $hash = hash("SHA256", $password);

                $sql = "INSERT INTO users(role, name, username, password, salt, email, address, area, contact) VALUES('$role', '$name', '$username', '$hash', '$salt', '$email', '$address', '$area', '$contact')";
               
                if (!mysqli_query($conn, $sql))
                {
                    echo("Error description: " . mysqli_error($conn));
                }
                if($role == 'Delivery'){
                    $id = mysqli_insert_id($conn);
                    $query = "INSERT INTO delivery(person_id) VALUES('$id')";
                    mysqli_query($conn, $query);
                }

                header("location:login.php");
            }
            else{
                echo "<script>alert('All Fields Are Required')</script>";
            }

        }
        else{
            echo "<script>alert('Username Already Taken')</script>";
        }
    }
?>

<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="css/form.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link href="https://fonts.googleapis.com/css?family=Italianno&display=swap" rel="stylesheet">
        <style type="text/css">
            .title {
                color: #FC8019;
                font-family: 'Italianno', cursive;
                font-size: 30px;
                margin: 10px;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
        </script>
        <script type="text/javascript">
            $('.message a').click(function(){
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
            });
        </script>
        <script type="text/javascript">
            function myFunction() {
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
            <center>
            <p class="title">Online Food Ordering System</p>
            </center>
        </div>
        <br>
        <center>
        <div class="page">
            <div class="form">
            <form method="post">
                <input type="text" name="name" required="true" placeholder="Name">
                <input type="text" name="user" required="true" placeholder="Username">
                <input type="password" name="pass" id="pass" required="true" placeholder="Password">
                <textarea name="address" rows="3" cols="31" placeholder="Address"></textarea>
                <select name="area">
                    <option name="area_select" selected>Select Area</option>
                    <option name="Ipsum">Ipsum</option>
                    <option name="Lorem">Lorem</option>
                </select>
                <select name="role" >
                    <option name="role_select" selected>Select Role</option>
                    <option name="user">Customer</option>
                    <option name="hotel">Hotel</option>
                    <option name="delivery">Delivery</option>
                </select>
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="contact" placeholder="Contact">
                <button type="submit" name="submit">Register</button>
                <p class="message">Registered already? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
        </center>
    </body>
</html>

