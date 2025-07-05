<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection

$ides = $_POST['ides'] ?? []; // Get product IDs from POST request
print_r($ides );
if (!empty($ides)) {
     $ids = implode(',' ,$ides) ;
     $sql = "DELETE FROM products WHERE id IN ($ids)";
        // Execute the SQL query to delete products
     if ($conn->query($sql) === TRUE) {
         header("Location: products_list.php?message=Products deleted successfully.");
     } else {
         echo "Error deleting products: " . $conn->error;
     }
    exit;
}