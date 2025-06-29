<?php
session_start(); // Start the session
session_destroy(); // Destroy all session data
header("Location: login.php?message=You have been logged out successfully.");
exit();