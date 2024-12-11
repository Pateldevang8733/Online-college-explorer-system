<?php
session_start();

require "mail.php";

$conn = mysqli_connect('localhost', 'root', '', 'collegearea');
if (!$conn) {
	die("Connection failed".mysqli_connect_error());
}

$message='';
$message2='';

$mode = "enter_email";
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}



if (count($_POST) > 0) {
	switch ($mode) {
		case 'enter_email':
			$email = $_POST['email'];
			
			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$message = "Please enter a valid email";
			} elseif (!valid_email($email)) {
				$message = "Email entered was not found";
			} else {
				$_SESSION['forgot']['email'] = $email;
				send_email($email);

				header("Location: forgot-password.php?mode=enter_code");
				die;
			}
			
			break;

		case 'enter_code':
			$code = $_POST['code'];
			$result = code_authentication($code);

			if ($result == "The Code is Correct") {
				$_SESSION['forgot']['code'] = $code;
				header("Location: forgot-password.php?mode=enter_password");
				die;
			}else{
				$message = $result;
			}
			break;

		case 'enter_password':
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];

			if ($password != $cpassword) {
				$message = "Passwords do not match";
			} elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
				header("Location: forgot-password.php");
			die;
			} else {
				save_password($password);
				if (isset($_SESSION['forgot'])) {
					unset($_SESSION['forgot']);
				}
				header("Location: login.php");
			die;
			}
			
			break;
		
		default:
		
			break;
	}
}

function send_email($email){
	global $conn;
	$expire = time() + (60 * 10);
	$code = rand(10000,99999);
	$email=addslashes($email);

	$query = "INSERT INTO resets (Email,Code,Expire)VALUES('$email','$code','$expire')";
	$query_run = mysqli_query($conn,$query) or die("Could not update");

	//send email
	send_mail($email,'Password Reset',"Your code is " . $code);
}

function code_authentication($code){
	global $conn;
	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "SELECT * FROM resets WHERE code = '$code' && email = '$email' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conn, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) 
		{
			$row = mysqli_fetch_assoc($result);
			if ($row['Expire'] > $expire) {
				return "The Code is Correct";
			}else{
				return "The Code Has Expired";
			}
		}else{
			return "The Code You've Entered is Incorrect";
		}
	}
	return "The Code You've Entered is Incorrect";
}

function save_password($password){
	global $conn;
	$password = $password;
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "UPDATE userlogin SET password ='$password' WHERE email = '$email' LIMIT 1";
	mysqli_query($conn,$query);
}

function valid_email($email){
	global $conn;
	$email = addslashes($email);

	$query = "SELECT * FROM userlogin WHERE email = '$email' LIMIT 1";
	$result = mysqli_query($conn, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) 
		{
			return true;
		}
	}

	return false;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
   
	<style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4; 
    margin: 0;
    padding: 0;
}


.container {
    width: 100%;
    max-width: 400px; 
    margin: 50px auto; 
    padding: 20px;
    background: white; 
    border-radius: 8px; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
}
h2 {
    text-align: center; 
    color: #333; 
    margin-bottom: 20px; 
}


.form-group {
    margin-bottom: 15px; 
	margin-left:0px;
}
label {
    display: block; 
    margin-bottom: 5px;
    font-weight: bold;
}


input[type="email"],
input[type="text"],
input[type="password"] {
    width: 100%; 
    padding: 10px; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
}


button {
    width: 100%; 
    padding: 10px; 
    background-color: #007bff; 
    border: none; 
    color: white; 
    border-radius: 4px;
    cursor: pointer; 
    font-size: 16px; 
    transition: background-color 0.3s ease; 
}


button:hover {
    background-color: #0056b3;
}


.link {
    text-align: center; 
    margin-top: 10px; 
}

.link a {
    color: #007bff; 
    text-decoration: none; 
}

.link a:hover {
    text-decoration: underline; 
}


.error-message {
    color: red; 
    text-align: center; 
    margin-top: 10px; 
    font-size: 14px;
}

		</style>
</head>
<body>
	

<div class="container">
    <?php
    switch ($mode) {
        case 'enter_email':
    ?>
        <div class="form-container">
            <h2>Forgot Password</h2>
            <form action="forgot-password.php" method="POST" autocomplete="">
                <div class="form-group">
             <!--    <label for="email">Enter email address:</label>-->
                    <input type="email" name="email" placeholder="Enter email address" required>
                </div>
                <button type="submit" name="check-email">Reset</button>
                <div class="link">
                    <a href="login.php">Back</a>
                </div>
            </form>
            <small class="error-message"><?php echo $message; ?></small>
        </div>
    <?php
            break;

        case 'enter_code':
    ?>
        <div class="form-container">
            <h2>Code Verification</h2>
            <p>Enter the code sent to your email. <strong>Code expires in 10 minutes!</strong></p>
            <form action="forgot-password.php?mode=enter_code" method="POST">
                <div class="form-group">
                    <label for="code">Enter Code:</label>
                    <input type="text" name="code" placeholder="Enter Code" required>
                </div>
                <button type="submit" name="SavePassChanges">Next</button>
                <div class="link">
                    <a href="forgot-password.php">Restart Reset</a>
                </div>
            </form>
            <small class="error-message"><?php echo $message; ?></small>
        </div>
    <?php
            break;

        case 'enter_password':
    ?>
        <div class="form-container">
            <h2>Reset Password</h2>
            <form action="forgot-password.php?mode=enter_password" method="POST">
                <div class="form-group">
                    <label for="password">Enter New Password:</label>
                    <input type="password" name="password" placeholder="Enter New Password" required>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="SavePassChanges">Continue</button>
                <div class="link">
                    <a href="forgot-password.php">Restart Reset</a>
                </div>
            </form>
            <small class="error-message"><?php echo $message; ?></small>
        </div>
    <?php
            break;

        default:
         
            break;
    }
    ?>
</div>

</body>
</html>
