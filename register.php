<?php
require("conn.php");
?>
<?php
if(isset($_POST["userregister"]))
{

$name=$_POST['username'];
$pass=$_POST['pass'];
$email=$_POST['email'];
$user='user';
echo "$user";


   

$query="INSERT INTO `userlogin`(`username`, `password`, `Email`,`type`) VALUES ('$name','$pass','$email','$user')";
mysqli_query($con,$query);
header("location:login.php");

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sty.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>




<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register Form</title>
        <link rel="stylesheet" href="styles.css">
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
                    <button
                        style="background-color: white; color: black; border: 1px solid black; font-size: 12px; width: 20px; height: 20px; cursor: pointer; line-height: 18px; text-align: center; padding: 0; float: right;"
                        onclick="window.location.href='home.php';">
                        X
                    </button>
                </div>
                <div class="login-header">
                    <img src="./image/user.png" alt="User Icon" class="user-icon">
                    <h2>Register</h2>
                </div>
                <form method="POST">
                    <input type="text" placeholder="Username" required name="username">
                   
                    <input type="E-mail" placeholder="E-mail" required name="email">
                    <input type="password" placeholder="Password" required name="pass">
                    <button type="submit" name=userregister>Sign up</button>
                </form>
                <p>Are you already Register? <a href="login.php">Login</a></p>
            </div>
        </div>



    </body>



    </html>