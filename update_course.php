<?php
session_start();
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegearea";

// Check if both course_id and college_id are provided
if (!isset($_GET['course_id']) || !isset($_GET['college_id'])) {
    die("Course or College ID not specified.");
}

$course_id = $_GET['course_id'];
$college_id = $_GET['college_id'];

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch course information for the given course_id and college_id
    $sql = "SELECT * FROM course WHERE course_id = :course_id AND college_id = :college_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':course_id', $course_id);
    $stmt->bindParam(':college_id', $college_id);
    $stmt->execute();

    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$course) {
        die("Course not found.");
    }

    // Check if form was submitted to update the course
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_name = $_POST['course_name'];
        $course_duration = $_POST['course_duration'];
        $course_fees = $_POST['course_fees'];

        // Update course information
        $sql = "UPDATE course SET course_name = :course_name, course_duration = :course_duration, course_fees = :course_fees WHERE course_id = :course_id AND college_id = :college_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':course_name', $course_name);
        $stmt->bindParam(':course_duration', $course_duration);
        $stmt->bindParam(':course_fees', $course_fees);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':college_id', $college_id);
        $stmt->execute();

        echo "<script>alert('Course information updated successfully.');</script>";
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
    <title>Update Course</title>
    <link rel="stylesheet" href="sty.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
    }
    .form-container {
            background: white;
            padding: 30px;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-top:100px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        textarea,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            padding: 5px;
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
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Blue background */
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }   
</style>
<script>
        // JavaScript to redirect to the admin logged page
        function goToAdminPage() {
            window.location.href = 'viewcollege.php'; // Redirect to the specified page
        }
    </script>

</head>
<body>
<?php include "adminheader.php"; ?> <!-- Include your admin header -->
<!-- <h2><span style="display: block; text-align: center;">Update course Information</span></h2> -->
<div class="form-container">
<button class="back-button" onclick="goToAdminPage()">Back</button>  
<h2>Update course Information</h2>
        <form action="update_course.php?college_id=<?php echo htmlspecialchars($college_id); ?>&course_id=<?php echo htmlspecialchars($course_id); ?>" method="post">
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" class="form-control" name="course_name" id="course_name" value="<?php echo htmlspecialchars($course['course_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="course_duration" >Duration</label>
                <input type="text" class="form-control" name="course_duration" id="course_duration" value="<?php echo htmlspecialchars($course['course_duration']); ?>">
            </div>
            <div class="form-group">
                <label for="course_fees" >Fees</label>
                <input type="number" class="form-control" name="course_fees" id="course_fees" value="<?php echo htmlspecialchars($course['course_fees']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
</body>
</html>
 