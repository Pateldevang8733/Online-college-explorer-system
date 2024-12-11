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

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $college_id = isset($_GET['college_id']) ? $_GET['college_id'] : null;

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_name = $_POST['course_name'];
        $course_duration = $_POST['course_duration'];
        $course_fees = $_POST['course_fees'];

       
        $sql = "INSERT INTO course (college_id, course_name, course_duration, course_fees)
                VALUES (:college_id, :course_name, :course_duration, :course_fees)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':college_id', $college_id);
        $stmt->bindParam(':course_name', $course_name);
        $stmt->bindParam(':course_duration', $course_duration);
        $stmt->bindParam(':course_fees', $course_fees);

        $stmt->execute();
        echo "<script>alert('Course added successfully!');</script>";
    }

  
    $college = null;
    if ($college_id) {
        $stmt = $conn->prepare("SELECT college_name FROM college WHERE college_id = :college_id");
        $stmt->bindParam(':college_id', $college_id);
        $stmt->execute();
        $college = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }
        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .back {
            text-align: center;
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Blue background */
            color: white;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #0056b3; 
        }

        
    </style>
</head>
<?php include "adminheader.php"; ?>
<body>
    <div class="form-container">
        
        <div class="back">
            <a href="viewcollege.php" class="back-button">Back</a>
        </div>

       
        <h2>Add Course for <?= htmlspecialchars($college['college_name'] ?? "Unknown College"); ?></h2>
        <form method="post">
            <input type="hidden" name="college_id" value="<?= htmlspecialchars($college_id); ?>">

            <div class="form-group">
                <label for="course_name">Course Name:</label>
                <input type="text" id="course_name" name="course_name" required>
            </div>
            <div class="form-group">
                <label for="course_duration">Course Duration:</label>
                <input type="text" id="course_duration" name="course_duration" required>
            </div>
            <div class="form-group">
                <label for="course_fees">Course Fees:</label>
                <input type="text" id="course_fees" name="course_fees" required>
            </div>

            <input type="submit" class="submit-button" value="Add Course">
        </form>
    </div>
</body>
</html>
