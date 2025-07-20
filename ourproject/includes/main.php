<?php
session_start(); // Start the session to access session variables
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user'])) {
  //  header("Location: login.php?error=Please login to access this page.");
  //  exit();
}
if(isset($_GET['lang']) && in_array($_GET['lang'], ['en',  'ar'])) {
    $_SESSION['language'] = $_GET['lang'];
} 

$language = $_SESSION['language'] ?? 'en'; // Default language is English

if($language == 'ar') {
    include_once 'languages/ar.php';
} else {
    include_once 'languages/en.php';
}
?>
