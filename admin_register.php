<?php
session_start();
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}
?>
<?php
require("conn.php");
?>
<?php

if(isset($_POST["register"]))
{
   
$name=$_POST['username'];
$pass=$_POST['pass'];
$email=$_POST['email'];
$passkey = $_POST['passkey'];
$admin='admin';


if($passkey == "add") {

    $query = "INSERT INTO `admin_login`(`admin_name`, `admin_pass`, `admin_email`,`type`) VALUES ('$name', '$pass', '$email','$admin')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Admin Added Successfully');</script>";
        header("location:adminlogedpage.php");
        exit; 
    } else {
        echo "<script>alert('Error: Could not register the admin.')</script>";
    }
} else {
    echo "<script>alert('Invalid passkey. Registration failed.')</script>";
}
}
?>





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_register</title>
    <?php
    include("links.php");?>
   
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        
    </head>



        <body>
            <div class="main_container">

                <body style="background-color:black ;">
                
                   <?php include("header.php");
                   include("middleportion.php");
                    include("footer.php");?>          


            <div class="login-overlay">
                <div class="login-box">
                <div class="cancel" style="width: 320px;height: 20px;padding-bottom: 20px;">
  <button style="background-color: white; color: black; border: 1px solid black; font-size: 12px; width: 20px; height: 20px; cursor: pointer; line-height: 18px; text-align: center; padding: 0; float: right;" 
    onclick="window.location.href='adminlogedpage.php';">
    X
  </button>
</div>
                    <div class="login-header">
                        <img src="./image/user.png" alt="User Icon" class="user-icon">
                        <h2>Register - Admin</h2>
                    </div>
                    <form method=POST>
                        <input type="text" placeholder="Username" name="username"  required >
                        <input type="E-mail" placeholder="E-mail" name="email" required>
                        <input type="password" placeholder="Password" name="pass" required >
                      
                        <input type="text" placeholder="pass key" name="passkey">

                   
                       
                        <button type="submit" name="register">Register</button>
                    
                    <p>Are you already Register? <a href="admin_login.php">Login</a></p>
                    </form>
                </div>
            </div>



            </body>



        </html>