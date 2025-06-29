<?php
session_start(); // Start the session to access session variables
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php?error=Please login to access this page.");
    exit();
}