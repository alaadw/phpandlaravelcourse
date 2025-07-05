<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product ID
    $productId = intval($_POST['id']);
    // Get form data
    $productName = $_POST['product_name'];
    $categoryId = intval($_POST['category_id']);
    $productDescription = $_POST['product_description'];
    $productPrice = floatval($_POST['product_price']);
    $productImage = $_FILES['product_image'];
    $featured  = $_POST['featured'] ?? 0;

    // Validate and process image upload
    if ($productImage['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($productImage['name']);
        move_uploaded_file($productImage['tmp_name'], $imagePath);
    } else {
        $imagePath = $_POST['existing_image']; // Keep existing image if no new upload
    }

    // Update product in database
    $sql = "UPDATE products SET name = '$productName',featured ='$featured' , category_id = '$categoryId', description = '$productDescription', price = '$productPrice', image = '$imagePath' WHERE id = $productId";


    if ($conn->query($sql)) {
        header("Location: products_list.php?message=Product updated successfully.");
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}