<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['id']) ? intval($_POST['id']) : 0;
     
    // Check if product ID is valid
    if ($productId > 0) {
        // Add the product to the cart (this is just a simulation)
        $_SESSION['cart'][] = $productId;
        $sql = "INSERT INTO cart (user_id, product_id) VALUES (" . $_SESSION['user']['id'] . ", $productId)";
        $conn->query($sql);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    }
}else {
    // If not a POST request, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}