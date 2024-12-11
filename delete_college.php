<?php
session_start();


if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}


if (isset($_GET['college_id'])) {
    $college_id = $_GET['college_id'];

  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "collegearea";

    try {
    
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $sql = "DELETE FROM college WHERE college_id = :college_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':college_id', $college_id, PDO::PARAM_INT);

       
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            
            $_SESSION['message'] = "College deleted successfully!";
        } else {
         
            $_SESSION['error'] = "College not found.";
        }

        header("Location: viewcollege.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: viewcollege.php");
        exit();
    }
}
?>
