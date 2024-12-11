<?php
session_start(); 
if (isset($_SESSION["email"])) {
    session_destroy();
}
$message = "";
require("conn.php");

if (isset($_POST['userlogin'])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Avoid SQL injection by using prepared statements
    $query = "SELECT * FROM userlogin WHERE `Email` = ? AND `Password` = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind parameters and execute
        mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $result_fetch = mysqli_fetch_assoc($result);

                // Set session variables
                $_SESSION['email'] = $_POST["email"];
                $_SESSION['id'] = $result_fetch['id'];
                $_SESSION['type'] = $result_fetch['type'];
                $_SESSION['lid'] = $result_fetch['id']; // Set the login ID in session

                // Log user login in audit table
                $log_login_sql = "INSERT INTO audit_table VALUES ('', ?, CURRENT_TIMESTAMP, ?, NULL)";
                if ($log_stmt = mysqli_prepare($con, $log_login_sql)) {
                    mysqli_stmt_bind_param($log_stmt, "is", $_SESSION['id'], $_SESSION['type']);
                    mysqli_stmt_execute($log_stmt);
                    $_SESSION['lid'] = mysqli_insert_id($con); // Store login_id in session
                }

                // Redirect user after successful login
                header("location:userlogedpage.php");
                exit;
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('User not found');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROJECT</title>
    <link rel="stylesheet" href="sty.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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
                <h2>Login</h2>
            </div>
            <form method="POST">
                <input type="text" placeholder="email" name="email" required>
                <input type="password" placeholder="Password" name="pass" required>
                <button type="submit" name="userlogin">Sign in</button>

                <p>Are you new to the college area? <a href="register.php">Register</a></p>

                <div class="link forget-pass text-center">Forgot password? <a href="forgot-password.php"> Reset here</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>
</div>
</div>
</div>


</body>

</html>