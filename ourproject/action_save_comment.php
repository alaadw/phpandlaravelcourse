<?php
require 'config/database.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    // Validate input
    if ($productId > 0 && !empty($name) && !empty($comment)) {
        // Prepare and execute insert query
        $sql = $conn->query("INSERT INTO product_comments (product_id, user_name, comment)
        VALUES ('{$productId}', '{$name}', '{$comment}')");
        if ($sql) {
            header("Location: product.php?id={$productId}#comments");
            exit();
        } else {
            echo "Error saving comment.";
        }
    } else {
        echo "Invalid input.";
    }
}