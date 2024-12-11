<?php
session_start(); 
require("conn.php");

if (isset($_SESSION["adminloginid"])) {
    session_destroy();
}

if (isset($_POST["signin"])) {
    $email = $_POST['Adminemail'];
    $pass = $_POST['Adminpass'];

    if ($email === 'admin@gmail.com' && $pass === 'admin') {
       
        $_SESSION['adminloginid'] = $email;
        header("location:adminlogedpage.php"); 
        exit;
    } else {
        
        $query = "SELECT * FROM admin_login WHERE `admin_email`='$email' AND `admin_pass`='$pass'";
        $result = mysqli_query($con, $query);
        $result2 = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
         
            $_SESSION['adminloginid'] = $email;

            
            $_SESSION['aid'] = $result2['admin_id'];
            $admin_id =  $_SESSION['aid'];
            $_SESSION['type'] = $result_fetch['type'];
            $type = $result_fetch['type'];

            $log_login_sql = "INSERT INTO audit_table VALUES ('',$admin_id, CURRENT_TIMESTAMP,'admin',NULL)";
            mysqli_query($con, $log_login_sql);
           $_SESSION['lid'] = mysqli_insert_id($con);
           
            header("location:adminlogedpage.php"); 
            exit;
        } else {
            echo "<script>alert('Invalid email or password. Please try again.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_login</title>
    
    <?php
    include("links.php");?>
   

    <body>
        <div class="main_container">

            <body style="background-color:black ;">
                <?php
                include("header.php");
               include("middleportion.php");
                include("footer.php");
                ?>


       
      <div class="login-overlay">
            <div class="login-box">
            <div class="cancel" style="width: 320px;height: 20px;padding-bottom: 20px;">
  <button style="background-color: white; color: black; border: 1px solid black; font-size: 12px; width: 20px; height: 20px; cursor: pointer; line-height: 18px; text-align: center; padding: 0; float: right;" 
    onclick="window.location.href='home.php';">
    X
  </button>
</div>
                <div class="login-header">
                    <img src="./image/user.png" alt="User Icon" class="user-icon">
                    <h2>Login - Admin</h2>
                </div>
                <form method="POST">
                    <input type="text" placeholder="Email" name="Adminemail" required>
                    <input type="password" placeholder="Password" name="Adminpass" required>
                    <button type="submit" name="signin">Login</button>
             

                  </form>
                </div>

        </div>

       

       

        </body>

    </html>