<?php
require 'config/database.php'; // Include database connection

if(isset($_POST['id'])) {
    $user_id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare SQL statement to prevent SQL injection
   $sql = "update users set name = '{$username}', email = '{$email}' where id = {$user_id} ";
  
   // die("SQL: " . $sql); // Debugging line to check the SQL query
    if ( $conn->query($sql) === TRUE) {
        // Handle file upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "uploads/";
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_dir . $user_id . ".jpg");
            // Update image path in database
            $stmt = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
            $image_name = $user_id . ".jpg";
            $stmt->bind_param("si", $image_name, $user_id);
            $stmt->execute();
        }
        header("Location: users_list.php?msg=User updated successfully.");
    } else {
        echo "Error updating user: " . $conn->error;
    }
    
    $stmt->close();
} else {
    header("Location: users_list.php?msg=Invalid request.");

}