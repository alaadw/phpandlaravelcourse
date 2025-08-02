<?php
require'config/database.php'; // Include database connection
//echo "<pre>";
//print_r($_POST);
//print_r($_FILES);

$name = $_POST['username'];
$email = $_POST['email'];   
$password = md5($_POST['password']);
$type = isset($_POST['user_type']) ? $_POST['user_type'] : 0; // Default to 'user' if not set

$sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password','$type')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    
    // Handle file upload
   if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $target_dir = "uploads/";
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_dir . $last_id . ".jpg");
        $sql = "UPDATE users SET image = '$last_id.jpg' WHERE id = $last_id";
        if ($conn->query($sql) === TRUE) {
            echo "Profile picture uploaded successfully.";
        } else {
            echo "Error updating profile picture: " . $conn->error;
        }   
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: users_list.php?msg=Registration successful, please login.");