<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userloged page</title>
    <link rel="stylesheet" href="collegestyle.css" />
   
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegearea";

try {
    include("userheader.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

  
    if ($searchTerm) {
        $sql = "SELECT * FROM college WHERE college_name LIKE :searchTerm";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM college";
        $stmt = $conn->query($sql);
    }

    $stmt->execute();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<h1>Colleges List</h1>

<!-- Search Form -->
<div class="search-form">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by college name" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<?php

if ($stmt->rowCount() > 0) {
    while ($college = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='college'>";
       
        if ($college['college_img']) {
            echo "<img src='" . htmlspecialchars($college['college_img']) . "' alt='College Image'>";
        }

        // College details
        echo "<div class='college-details'>";
        echo "<h2>" . htmlspecialchars($college['college_name']) . "</h2>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($college['college_place']) . "</p>";
        echo "<p><strong>Type:</strong> " . htmlspecialchars($college['college_type']) . "</p>";
        echo "<p><strong>Rating:</strong> " . htmlspecialchars($college['college_rating']) . "</p>";
        echo "<p><strong>Category:</strong> " . htmlspecialchars($college['college_category']) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($college['college_description']) . "</p>";
        if ($college['college_url']) {
            echo "<p><a href='" . htmlspecialchars($college['college_url']) . "' target='_blank'>Visit Website</a></p>";
        }

       
        $college_id = $college['college_id'];
        $sql_courses = "SELECT * FROM course WHERE college_id = :college_id";
        $stmt_courses = $conn->prepare($sql_courses);
        $stmt_courses->bindParam(':college_id', $college_id);
        $stmt_courses->execute();
        
        if ($stmt_courses->rowCount() > 0) {
            echo "<h3>Courses Offered:</h3>";
            echo "<ul>";
            
            while ($course = $stmt_courses->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo "<strong>Course Name:</strong> " . htmlspecialchars($course['course_name']) . "<br>";
                echo "<strong>Duration:</strong> " . htmlspecialchars($course['course_duration']) . "<br>";
                echo "<strong>Fees:</strong> Rs." . htmlspecialchars($course['course_fees']) . "<br>";
                echo "</li>";
            }
            
            echo "</ul>";
        } else {
            echo "<p>No courses available for this college.</p>";
        }

        echo "</div>"; 
        echo "</div><hr>"; 
    }
} else {
    echo '<p style="border: 1px solid #ccc; padding: 10px; background-color: #ffffe0; color: #333; 
    text-align: center; width: 300px; margin: 20px auto; border-radius: 5px;">
 No colleges found.
</p>';

}

$conn = null;
?>

</body>
</html>


            
