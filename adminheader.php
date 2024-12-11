<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['out'])) {
    session_destroy(); 
    header("location:admin_login.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Header</title>
    <?php include("links.php"); ?> 
    <style>
      .mainn{
        
        margin-top:130px;
      
      }
      /* Remove the default link styles inside the button */
.logout-link {
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit the color from the button */
}

    
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="./image/logo2.png" alt="Logo">
        </div>
        <h1 style="text-align: center; font-family: 'Arial', sans-serif; font-weight: bold; color: #333; margin-top: -20px;margin-left: 425px">
    <span style="color: black; font-size: 28px;">
        Welcome to  <?php echo htmlspecialchars($_SESSION['adminloginid'] ?? ''); ?>
    </span>
</h1>

        <div class="nav">
        <div class="btn">
                <a href="admin_register.php">
                    <button type="button" class="btn btn-outline-warning">Add Admin</button>
                </a>
            </div>
            <div class="btn">
                <a href="history2.php">
                    <button type="button" class="btn btn-outline-warning">History</button>
                </a>
            </div>
        </div>
        <!-- Logout Button -->
        <form method="post">
        <div class="btn">
    <button class="btn btn-primary me-md-2" name="out" type="submit">
        <a href="logout2.php" class="logout-link">Log Out</a>
    </button>
</div>

        </form>
       
    </div>
    <div class="mainn">

</div>
</body>
</html>
