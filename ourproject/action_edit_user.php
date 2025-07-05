<?php
require 'config/database.php'; // Include database connection

if(isset($_POST['id']) ) {
    $user_id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare SQL statement to prevent SQL injection
   $sql = "update users set name = '{$username}', email = '{$email}' where id = {$user_id} ";
  
   // die("SQL: " . $sql); // Debugging line to check the SQL query
    if ( $conn->query($sql) === TRUE) {
        // Handle file upload
        
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            if(!file_exists('uploads')) {
                mkdir('uploads', 0777, true); // Create uploads directory if it doesn't exist
            }
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if(!in_array($_FILES['profile_picture']['type'], $allowed_types)) {
                die("Invalid file type. Only JPG, PNG, and GIF files are allowed.");
            }
            if($_FILES['profile_picture']['size'] > 500000) {
                die("File size exceeds limit.");
            }
            
            $target_dir = "uploads/";
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_dir . $user_id . ".jpg");
            // Update image path in database
			 $image_name = $user_id . ".jpg";
             $conn->query("UPDATE users SET image = '{$image_name}' WHERE id = '{$user_id}'");
            
			
        }
        header("Location: users_list.php?msg=User updated successfully.");
    } else {
        echo "Error updating user: " . $conn->error;
    }
    
    $stmt->close();
} else {
    header("Location: users_list.php?msg=Invalid request.");

}