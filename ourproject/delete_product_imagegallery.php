<?php
require 'config/database.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageId = intval($_REQUEST['id']);
    // Delete image from product_gallery table
    $sql = "DELETE FROM product_gallery WHERE id = {$imageId}";
    if ($conn->query($sql) === TRUE) {
        echo "Image deleted successfully.";
    } else {
        echo "Error deleting image: " . $conn->error;
    }
}