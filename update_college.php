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


if (!isset($_GET['college_id'])) {
    die("College ID not specified.");
}

$college_id = $_GET['college_id'];

try {
   
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
    $sql = "SELECT * FROM college WHERE college_id = :college_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':college_id', $college_id);
    $stmt->execute();
    
    $college = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$college) {
        die("College not found.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fields_to_update = [];
        $params = [':college_id' => $college_id];

        // Check each field for changes
        if (!empty($_POST['college_name']) && $_POST['college_name'] != $college['college_name']) {
            $fields_to_update[] = "college_name = :college_name";
            $params[':college_name'] = $_POST['college_name'];
        }
        if (!empty($_POST['college_place']) && $_POST['college_place'] != $college['college_place']) {
            $fields_to_update[] = "college_place = :college_place";
            $params[':college_place'] = $_POST['college_place'];
        }
        if (!empty($_POST['college_type']) && $_POST['college_type'] != $college['college_type']) {
            $fields_to_update[] = "college_type = :college_type";
            $params[':college_type'] = $_POST['college_type'];
        }
        if (!empty($_POST['college_rating']) && $_POST['college_rating'] != $college['college_rating']) {
            $fields_to_update[] = "college_rating = :college_rating";
            $params[':college_rating'] = $_POST['college_rating'];
        }
        if (!empty($_POST['college_category']) && $_POST['college_category'] != $college['college_category']) {
            $fields_to_update[] = "college_category = :college_category";
            $params[':college_category'] = $_POST['college_category'];
        }
        if (!empty($_POST['college_description']) && $_POST['college_description'] != $college['college_description']) {
            $fields_to_update[] = "college_description = :college_description";
            $params[':college_description'] = $_POST['college_description'];
        }
        if (!empty($_POST['college_url']) && $_POST['college_url'] != $college['college_url']) {
            $fields_to_update[] = "college_url = :college_url";
            $params[':college_url'] = $_POST['college_url'];
        }

        
        $target_file = $college['college_img']; // Default to current image
        if (!empty($_FILES['college_img']['name'])) {
            // Handle file upload
            $target_dir = "image/";
            $file_name = basename($_FILES["college_img"]["name"]);
            $file_name = str_replace(' ', '_', $file_name);
            $target_file = $target_dir . $file_name;

            // Check if the file is an image
            $check = getimagesize($_FILES["college_img"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                exit();
            }

            // Move the uploaded file
            if (move_uploaded_file($_FILES["college_img"]["tmp_name"], $target_file)) {
                $fields_to_update[] = "college_img = :college_img";
                $params[':college_img'] = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        }

   
        if (!empty($fields_to_update)) {
            $sql = "UPDATE college SET " . implode(", ", $fields_to_update) . " WHERE college_id = :college_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            echo "<script>alert('The college information has been updated successfully.');</script>";
        } else {
            echo "No changes were made.";
        }
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
    <title>Update College</title>
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

<?php include "adminheader.php"; ?>

<body>
    <div class="form-container">
 <button class="back-button" onclick="goToAdminPage()">Back</button>  
        <h2>Update College Information</h2>
        
        <form action="update_college.php?college_id=<?php echo htmlspecialchars($college['college_id']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="college_id" value="<?php echo htmlspecialchars($college['college_id']); ?>">
            <div class="form-group">
                <label for="college_name">College Name:</label>
                <input type="text" id="college_name" name="college_name" value="<?php echo htmlspecialchars($college['college_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="college_img">College Image:</label>
                <input type="file" id="college_img" name="college_img" accept="image/*">
            </div>

            <div class="form-group">
                <label for="college_rating">College Rating:</label>
                <input type="text" id="college_rating" name="college_rating" value="<?php echo htmlspecialchars($college['college_rating']); ?>" required>
            </div>

            <div class="form-group">
                <label for="college_place">College Location:</label>
                <input type="text" id="college_place" name="college_place" value="<?php echo htmlspecialchars($college['college_place']); ?>" required>
            </div>

            <div class="form-group">
                <label for="college_type">College Type:</label>
                <input type="text" id="college_type" name="college_type" value="<?php echo htmlspecialchars($college['college_type']); ?>" required>
            </div>

            <div class="form-group">
                <label for="college_url">College Website URL:</label>
                <input type="text" id="college_url" name="college_url" value="<?php echo htmlspecialchars($college['college_url']); ?>">
            </div>

            <div class="form-group">
                <label for="college_category">College Category:</label>
                <select id="college_category" name="college_category">
    
        <option value="Private" <?php if ($college['college_category'] == 'Private') echo 'selected'; ?>>Private</option>
        <option value="Semi-Government" <?php if ($college['college_category'] == 'Semi-Government') echo 'selected'; ?>>Semi-Government</option>
        <option value="Government" <?php if ($college['college_category'] == 'Government') echo 'selected'; ?>>Government</option>
    </select>
            </div>

            <div class="form-group">
                <label for="college_description">Description:</label>
                <textarea id="college_description" name="college_description" rows="4" ><?php echo htmlspecialchars($college['college_description']); ?></textarea>
            </div>

            <button type="submit" class="submit-button">Update College</button>
        </form>
    </div>
</body>
</html>
