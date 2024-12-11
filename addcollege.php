<?php
session_start();
if (!isset($_SESSION['adminloginid'])) {
    header("location:admin_login.php");
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "collegearea";

    try {
     
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $college_name = isset($_POST['college_name']) ? $_POST['college_name'] : '';
        $college_place = isset($_POST['college_place']) ? $_POST['college_place'] : '';
        $college_type = isset($_POST['college_type']) ? $_POST['college_type'] : '';
        $college_rating = isset($_POST['college_rating']) ? $_POST['college_rating'] : '';
        $college_category = isset($_POST['college_category']) ? $_POST['college_category'] : '';
        $college_description = isset($_POST['college_description']) ? $_POST['college_description'] : '';
        $college_url = isset($_POST['college_url']) ? $_POST['college_url'] : '';

        if (isset($_FILES["college_img"]) && $_FILES["college_img"]["error"] == 0) {
            $target_dir = "image/"; 
            $file_tmp = $_FILES["college_img"]["tmp_name"];
            $file_name = basename($_FILES["college_img"]["name"]);
            $target_file = $target_dir . $file_name;

            $uploadOk = 1;

           
            $mime_type = mime_content_type($file_tmp);
            $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'];

            if (!in_array($mime_type, $allowed_mimes)) {
                echo "<script>alert('File is not a valid image. Only JPG, PNG, GIF, BMP, and WEBP formats are allowed.');</script>";
                $uploadOk = 0;
            }

            if ($_FILES["college_img"]["size"] > 10000000) {
                echo "<script>alert('File size exceeds 10Mb limit. Please upload a smaller image.');</script>";
                $uploadOk = 0;
            }

         
            if ($uploadOk == 1) {
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $college_img = $target_file;
                } else {
                    echo "<script>alert('Error uploading the file.');</script>";
                    $college_img = '';
                }
            } else {
                $college_img = ''; 
            }
        } else {
            $college_img = ''; 
        }

       
        $sql = "INSERT INTO college (college_name, college_place, college_type, college_rating, college_category, college_description, college_url, college_img) 
                VALUES (:college_name, :college_place, :college_type, :college_rating, :college_category, :college_description, :college_url, :college_img)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':college_name', $college_name);
        $stmt->bindParam(':college_place', $college_place);
        $stmt->bindParam(':college_type', $college_type);
        $stmt->bindParam(':college_rating', $college_rating);
        $stmt->bindParam(':college_category', $college_category);
        $stmt->bindParam(':college_description', $college_description);
        $stmt->bindParam(':college_url', $college_url);
        $stmt->bindParam(':college_img', $college_img);

      
        $stmt->execute();
        echo "<script>alert('The college information has been saved successfully.');</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add College</title>
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
            margin-top:30px;
            background: white;
            padding: 30px;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
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
        input[type="number"],
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
            background-color: #0056b3; 
        }

    
    </style>
    <script>
       
        function goToAdminPage() {
            window.location.href = 'adminlogedpage.php'; 
        }
    </script>
</head>

<?php include "adminheader.php"; ?>

<body>

    <div class="form-container">
    <button class="back-button" onclick="goToAdminPage()">Back</button>  <h2>Add College</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="college_name">College Name:</label>
                <input type="text" id="college_name" name="college_name" maxlength="255" required>

            </div>

            <div class="form-group">
                <label for="college_img">College Image:</label>
                <input type="file" id="college_img" name="college_img" accept="image/*">
            </div>

            <div class="form-group">
            <label for="college_rating">College Rating:</label>
    <input 
        type="number" 
        id="college_rating" 
        name="college_rating" 
        placeholder="ex: 1.0 to 10.0" 
        min="1.0" 
        max="10.0" 
        step="0.1" 
        required>

            </div>

            <div class="form-group">
                <label for="college_place">College Place:</label>
                <input type="text" id="college_place" name="college_place" required>
            </div>

            <div class="form-group">
                <label for="college_type">College Type:</label>
                <input type="text" id="college_type" name="college_type" required placeholder="ex:engineering , medical , arts , commerce">
            </div>

            <div class="form-group">
                <label for="college_url">College URL:</label>
                <input type="text" id="college_url" name="college_url">
            </div>

            <div class="form-group">
                <label for="college_description">College Description:</label>
                <textarea id="college_description" name="college_description"></textarea>
            </div>

            <div class="form-group">
                <label for="college_category">College Category:</label>
                <select id="college_category" name="college_category" required>
                    <option value="private">Private</option>
                    <option value="government">Government</option>
                    <option value="semi-government">Semi-Government</option>
                </select>
            </div>

            <input type="submit" value="Add College" class="submit-button">
        </form>
    </div>
</body>
</html>
