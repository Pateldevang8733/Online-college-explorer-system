<?php
session_start(); 
require("conn.php");

date_default_timezone_set('Asia/Kolkata'); // Set timezone

if (isset($_SESSION['adminloginid']) && isset($_SESSION['lid'])) {
    $login_id = $_SESSION['lid']; // Get session login ID
    $logout_time = date('Y-m-d H:i:s'); // Current time for logout

    // Debug logs
    error_log("Session - Admin Login ID: $login_id, Logout Time: $logout_time");

    // Update logout time in audit_table
    $update_sql = "UPDATE `audit_table` SET `logout_time` = ? WHERE `login_id` = ?";
    $stmt = $con->prepare($update_sql);

    if ($stmt) {
        $stmt->bind_param('si', $logout_time, $login_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                error_log("Logout time updated successfully for Login ID: $login_id");
                session_destroy();
                header("Location: admin_login.php");
                exit;
            } else {
                error_log("No rows updated for Login ID: $login_id. Verify the login record exists.");
                echo "<script>alert('No record found for the provided Login ID.');</script>";
            }
        } else {
            error_log("Error executing update query: " . $stmt->error);
            echo "<script>alert('Error updating logout time.');</script>";
        }
        $stmt->close();
    } else {
        error_log("Error preparing update statement: " . $con->error);
        echo "<script>alert('Error preparing update query.');</script>";
    }
} else {
    header("Location: admin_login.php");
    exit;
}
?>
