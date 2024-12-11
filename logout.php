<?php
session_start(); 
require("conn.php");

// Set the default timezone (change this as per your location)
date_default_timezone_set('Asia/Kolkata'); // Set to your local timezone

// Check if the user is logged in
if (isset($_SESSION['email']) && isset($_SESSION['lid'])) {
    // User is logged in
    $login_id = $_SESSION['lid']; // User ID from the session
    $u_id = $login_id; // Assuming the user's ID is stored as 'id'

    // Check if login_id is valid before proceeding
    if (empty($u_id)) {
        error_log("Logout failed: Invalid or missing login_id.");
        header("Location: login.php");
        exit;
    }

    // Get the current logout time
    $logout_time = date('Y-m-d H:i:s');
    
    // Debug: Log session and variable values for tracking
    error_log("Logout: User ID - $u_id, Logout Time - $logout_time");

    // Update the audit_table with the logout time for the user
    $update_sql = "UPDATE `audit_table` SET `logout_time` = ? WHERE `login_id` = ?";
    if ($stmt = $con->prepare($update_sql)) {
        // Bind parameters ('si' means string for date and integer for user id)
        $stmt->bind_param('si', $logout_time, $u_id);

        // Execute the update query
        if ($stmt->execute()) {
            // Check if any row was updated
            if ($stmt->affected_rows > 0) {
                // Successfully updated logout time, log out the user
                session_destroy();
                header("Location: login.php");
                exit;
            } else {
                // No row updated (could indicate a missing or incorrect login_id)
                error_log("No rows were updated for user ID: $u_id. This might mean there's no matching `login_id` in the `audit_table`.");
                echo "No record found for logout time update.";
            }
        } else {
            // Log SQL execution error
            error_log("Error executing query: " . $stmt->error);
            echo "Error updating logout time: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Log prepare statement error
        error_log("Error preparing statement: " . $con->error);
        echo "Error preparing statement: " . $con->error;
    }

} else {
    // If the session is not set properly, redirect to the login page
    error_log("User is not logged in. Redirecting to login page.");
    header("Location: login.php");
    exit;
}
?>
