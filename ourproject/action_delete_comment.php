<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentId = intval($_POST['id']);
    
    // Delete comment from product_comments table
    $sql = "DELETE FROM product_comments WHERE id = {$commentId}";
    if ($conn->query($sql) === TRUE) {
        header("Location: product_comments.php?msg=Comment deleted successfully.");
        exit();
    } else {
        header("Location: product_comments.php?error=Error deleting comment: " . $conn->error);
        exit();
    }
} else {
    header("Location: product_comments.php?error=Invalid request method.");
    exit();
}