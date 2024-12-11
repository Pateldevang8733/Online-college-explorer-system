<?php

session_start();
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="sty.css"> 
    <?php include("links.php"); ?>
    <style>
       
        .logedmain {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
           margin-top:0px;
        }

    
        .button-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

      
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            color:blue;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .add-btn {
            background-color: #28a745;
        }

        .add-btn:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .edit-btn {
            background-color: #ffc107;
        }

        .edit-btn:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <?php include "adminheader.php"; ?> 
   
    <div class="logedmain" style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center;">
    <div class="button-container" style="display: flex; gap: 20px;">
        <a href="addcollege.php" class="btn add-btn" style="padding: 10px 20px; font-size: 16px; font-weight: bold; text-decoration: none; border-radius: 5px; background-color: #4CAF50; color: white; text-align: center; transition: all 0.3s ease;">
            Add College
        </a>
        <a href="viewcollege.php" class="btn edit-btn" style="padding: 10px 20px; font-size: 16px; font-weight: bold; text-decoration: none; border-radius: 5px; background-color: #4CAF50; color: white; text-align: center; transition: all 0.3s ease;">
            View College
        </a>
    </div>
</div>

</body>
</html>

<?php

if (isset($_POST['out'])) {
    session_destroy(); 
    header("location:admin_login.php"); 
    exit(); 
}
?>
