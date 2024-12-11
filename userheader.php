
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['out'])) {
    session_destroy();
    header("location:login.php"); 
    exit(); 
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userheader</title>
    <?php
    include("links.php");
    ?>
     <style>
      .main{
        margin-top:140px;
      
      }
    /* Remove the default link styles inside the button */
.logout-link {
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit the color from the parent element (the button) */
}

    </style>
</head>
<body>

<div class="header">

<div class="logo">
    <img src="./image/logo2.png" />
</div>

<div class="nav">
     <!-- <div class="add">
    <p>
        <h4>About us</h4>
    </p>

    <p>
        <h4>Help</h4>
    </p>
    <p>

</div>   -->
     <div class="btn">
     <a href="userlogedpage.php">  <button type="button" class="btn btn-outline-primary">all</button></a>
     <a href="agri.php">  <button type="button" class="btn btn-outline-primary">Agriculture</button></a>
     <a href="medical.php">  <button type="button" class="btn btn-outline-primary">Medical</button></a>
     <a href="eng.php">  <button type="button" class="btn btn-outline-primary">Engineering</button></a>
     <a href="comm.php">   <button type="button" class="btn btn-outline-primary">Commerce</button></a>
     <a href="art.php"> <button type="button" class="btn btn-outline-primary">Arts</button></a>
     <a href="history.php">  <button type="button" class="btn btn-outline-primary">History</button></a>

 
    </div> 
    
<form method="post">
<div class="login_button">
    <button class="btn btn-primary me-md-2" name="out" type="submit">
        <a href="logout.php" class="logout-link">Log Out</a>
    </button>
</div>

     </form> 
       


           
            
        </div>
    </div>
    <div class="main">
        
                </div>
    
    
</body>
</html>
