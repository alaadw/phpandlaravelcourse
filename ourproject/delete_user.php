<?php
require 'config/database.php'; // Include database connection
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    
    // Delete user from database
    $sql = "DELETE FROM users WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        // Optionally delete the profile picture file
        $image_path = "uploads/" . $user_id . ".jpg";
        if (file_exists($image_path)) { // Check if the file exists
            unlink($image_path); // Delete the file if it exists
        }
        header("Location: users_list.php?msg=User deleted successfully.");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    header("Location: users_list.php?msg=Invalid user ID.");
}