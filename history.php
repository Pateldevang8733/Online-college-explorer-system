<?php

    session_start();
    if(!isset($_SESSION["email"]))
    {
        header("location:login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit</title>
    <link rel="stylesheet" href="sty.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .c {
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
      

    </style>
</head>

<body>
    
<div class="c">
    <?php  
    include "userheader.php";
    include "conn.php";

    $id = $_SESSION['id'];
    $qry = "SELECT * FROM audit_table WHERE u_id = $id ORDER BY login_id ASC";
    $rs = mysqli_query($con, $qry);
    echo "<div class='container mt-4'>";
    echo "<table class='table table-info table-hover text-center'>";
    echo "<thead class='table table-dark'><tr><th>Audit ID</th><th>User ID</th><th>Login Time</th><th>Logout Time</th><th>Type</th></tr></thead>";
    while ($val = mysqli_fetch_assoc($rs)) {
        echo "<tbody><tr>";
        echo "<td>".$val["login_id"]."</td>";
        echo "<td>".$val["u_id"]."</td>";
        echo "<td>".$val["login_time"]."</td>";
        echo "<td>".$val["logout_time"]."</td>";
        echo "<td>".$val["type"]."</td>";
        echo "</tr></tbody>";
    }
    echo "</table></div>";
    ?>
    
    <?php
    if(isset($_POST['out'])) {
        session_destroy();
        header("location:login.php");
    }
    ?>
</div>

</body>

</html>
