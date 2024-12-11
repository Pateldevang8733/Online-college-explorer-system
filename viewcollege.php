<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}

// Display success or error messages
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "');</script>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['error']) . "');</script>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colleges List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .center-container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #cccccc;
        }
        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #1a73e8;
            color: white;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #1a73e8;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .button:hover {
            background-color: #005bb5;
        }
        .search-input {
            padding: 10px;
            width: 70%;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        .college-section {
            border: 2px solid #cccccc;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<?php include "adminheader.php"; ?>
<body>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegearea";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle search query
    $searchQuery = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $searchQuery = $_POST['search'];
    }

    // Prepare SQL query with search filter
    $sql = "SELECT * FROM college WHERE college_name LIKE :searchQuery";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);

    echo "<h1>Colleges List</h1>";

    // Back button
    echo "<div>";
    echo "<a href='adminlogedpage.php' class='button'>Back To Dashboard</a>";
    echo "</div><br>";

    // Search box
    echo "<div class='center-container'>";
    echo "<form method='POST' style='margin-bottom: 20px;'>";
    echo "<input type='text' name='search' placeholder='Search colleges by name' value='" . htmlspecialchars($searchQuery) . "' class='search-input'>";
    echo "<button type='submit' class='button'>Search</button>";
    echo "</form>";

    if ($stmt->rowCount() > 0) {
        while ($college = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $college_id = $college['college_id'];

            echo "<div class='college-section'>";
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>College Details</th>";
            echo "<th>Actions</th>";
            echo "<th>Courses Offered</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            echo "<tr>";
            // College Details
            echo "<td>";
            echo "<h3>" . htmlspecialchars($college['college_name']) . "</h3>";

            if ($college['college_img']) {
                echo "<img src='" . htmlspecialchars($college['college_img']) . "' alt='College Image' style='width: 300px; height: 150px; object-fit: cover;'><br>";
            }
            echo "<strong>Location:</strong> " . htmlspecialchars($college['college_place']) . "<br>";
            echo "<strong>Type:</strong> " . htmlspecialchars($college['college_type']) . "<br>";
            echo "<strong>Rating:</strong> " . htmlspecialchars($college['college_rating']) . "<br>";
            echo "<strong>Category:</strong> " . htmlspecialchars($college['college_category']) . "<br>";
            echo "<strong>Description:</strong> " . htmlspecialchars($college['college_description']) . "<br>";
            if ($college['college_url']) {
                echo "<a href='" . htmlspecialchars($college['college_url']) . "' target='_blank'>Visit Website</a>";
            }
            echo "</td>";

            // College Actions
            echo "<td>";
            echo "<div class='buttons'>";
            echo "<a href='update_college.php?college_id=" . htmlspecialchars($college_id) . "' class='button'>Edit</a>";
            echo "<a href='delete_college.php?college_id=" . htmlspecialchars($college_id) . "' class='button' onclick='return confirm(\"Are you sure you want to delete this college?\");'>Delete</a>";
            echo "<a href='addcourse.php?college_id=" . htmlspecialchars($college_id) . "' class='button'>Add Course</a>";
            echo "</div>";
            echo "</td>";

            // Courses Offered
            echo "<td>";
            $sql_courses = "SELECT * FROM course WHERE college_id = :college_id";
            $stmt_courses = $conn->prepare($sql_courses);
            $stmt_courses->bindParam(':college_id', $college_id, PDO::PARAM_INT);
            $stmt_courses->execute();

            if ($stmt_courses->rowCount() > 0) {
                echo "<ul>";
                while ($course = $stmt_courses->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>";
                    echo "<strong>Name:</strong> " . htmlspecialchars($course['course_name']) . "<br>";
                    echo "<strong>Duration:</strong> " . htmlspecialchars($course['course_duration']) . "<br>";
                    echo "<strong>Fees:</strong> R" . htmlspecialchars($course['course_fees']) . "<br>";
                    echo "<div class='buttons'>";
                    echo "<a href='update_course.php?course_id=" . htmlspecialchars($course['course_id']) . "&college_id=" . htmlspecialchars($college_id) . "' class='button'>Update</a>";
                    echo "<a href='delete_course.php?course_id=" . htmlspecialchars($course['course_id']) . "&college_id=" . htmlspecialchars($college_id) . "' class='button' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No courses available.";
            }
            echo "</td>";
            echo "</tr>";

            echo "</tbody>";
            echo "</table>";
            echo "</div>"; // End of college-section
        }
    } else {
        echo '<p style="border: 1px solid #ccc; padding: 10px; background-color: #ffffe0; color: #333; 
    text-align: center; width: 300px; margin: 20px auto; border-radius: 5px;">
 No colleges found.
</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

</body>
</html>
