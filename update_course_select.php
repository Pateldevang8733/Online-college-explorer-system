<?php
session_start();
if(!isset($_SESSION['adminloginid']))
{
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


    $sql = "SELECT college_id, college_name FROM college";
    $stmt = $conn->query($sql);
    $colleges = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If a college is selected, fetch its courses
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['college_id'])) {
        $college_id = $_POST['college_id'];
        $sql_courses = "SELECT course_id, course_name FROM course WHERE college_id = :college_id";
        $stmt_courses = $conn->prepare($sql_courses);
        $stmt_courses->bindParam(':college_id', $college_id);
        $stmt_courses->execute();
        $courses = $stmt_courses->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Course to Update</title>
</head>
<body>
    <?php include "userheader.php"; ?>
    <div class="container">
        <h1>Select Course to Update</h1>
        <form action="" method="post">
            <div>
                <label for="college_id">Select College:</label>
                <select name="college_id" id="college_id" onchange="this.form.submit()" required>
                    <option value="">-- Select College --</option>
                    <?php foreach ($colleges as $college): ?>
                        <option value="<?php echo $college['college_id']; ?>" <?php echo (isset($college_id) && $college['college_id'] == $college_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($college['college_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if (isset($courses)): ?>
                <div>
                    <label for="course_id">Select Course:</label>
                    <select name="course_id" id="course_id" required>
                        <option value="">-- Select Course --</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?php echo $course['course_id']; ?>">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" formaction="update_course.php">Update Course</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
