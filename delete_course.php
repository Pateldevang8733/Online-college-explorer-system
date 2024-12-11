<?php
session_start();
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegearea";


if (!isset($_GET['course_id']) || !isset($_GET['college_id'])) {
    die("Course ID or College ID not specified.");
}

$course_id = $_GET['course_id'];
$college_id = $_GET['college_id'];

try {
  
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $sql = "DELETE FROM course WHERE course_id = :course_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
       
        echo "<script>alert('Course deleted successfully.'); window.location.href = 'viewcollege.php?college_id=" . htmlspecialchars($college_id) . "';</script>";
    } else {
        echo "<script>alert('Failed to delete the course.'); window.location.href = 'viewcollege.php?college_id=" . htmlspecialchars($college_id) . "';</script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;  
?>
