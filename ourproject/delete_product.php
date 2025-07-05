<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$id  = intval($_GET['id'] ?? 0); // Get product ID from query parameter

$sql = "DELETE FROM products WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: products_list.php?message=Product deleted successfully.");
} else {
    echo "Error deleting product: " . $conn->error;
}