<?php
require 'config/database.php'; // Include database connection

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));
    $sql = "select * from users where email = '$email' and password = '$password' limit 1";
    //echo $sql; // Debugging line to check the SQL query
    //die();
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        // User found, start session and redirect
        session_start();
        $_SESSION['user'] = $result->fetch_assoc();
        header("Location: users_list.php");
    } else {
        // Invalid credentials
        header("Location: login.php?error=Invalid username or password");
    }

} else {
    header("Location: login.php?error=Please enter username and password");
}