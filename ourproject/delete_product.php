<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$id  = intval($_REQUEST['id'] ?? 0); // Get product ID from query parameter

$sql = "DELETE FROM products WHERE id = $id";
//die($sql);
// update deleted product status
//$sql = "UPDATE products SET deleted = 1 WHERE id = $id"; // Soft delete
if ($conn->query($sql) === TRUE) {
    header("Location: products_list.php?message=Product deleted successfully.");
} else {
    echo "Error deleting product: " . $conn->error;
}