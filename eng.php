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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineering Colleges</title>
    <link rel="stylesheet" href="sty.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="collegestyle.css" />
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .college {
            background-color: #ffffff;
            border: 1px solid #cccccc;
            padding: 15px;
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .college img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .college-details h2, .college-details h3 {
            color: #333333;
            margin-top: 0;
        }

        .college-details p {
            margin: 8px 0;
            line-height: 1.6;
        }

        .college-details ul {
            padding-left: 20px;
            list-style-type: disc;
        }

        a {
            color: #1a73e8;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            border: none;
            height: 1px;
            background-color: #cccccc;
            margin-top: 20px;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 300px;
        }

        .search-form button {
            padding: 8px 15px;
            background-color: #1a73e8;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #005bb5;
        } */
    </style>
</head>
<body>

<?php
include("userheader.php");
?>

<h1>Engineering Colleges</h1>

<!-- Search Form -->
<div class="search-form">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by college name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collegearea";  // Replace 'x' with your actual database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Capture the search term if available
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // SQL query with search functionality
    $type = "engineering";
    if ($searchTerm) {
        $sql = "SELECT * FROM college WHERE college_type = :type AND college_name LIKE :searchTerm";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM college WHERE college_type = :type";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    }

    $stmt->execute();

    // Display colleges
    if ($stmt->rowCount() > 0) {
        while ($college = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='college'>";
          
            if ($college['college_img']) {
                echo "<img src='" . htmlspecialchars($college['college_img']) . "' alt='College Image'>";
            }
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
</p>';   }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

</body>
</html>

<?php
                    if(isset($_POST['out']))
                    {
                        session_destroy();
                        header("location:login.php");
                    }
                ?>
            
