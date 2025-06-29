<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image'];
    $sql = "insert into products (name, category_id, description, price) values ( '$product_name', '$category_id', '$product_description', '$product_price')";
    // Validate and process form data
    if ($conn->query($sql) === TRUE) {
        // Handle file upload
        if ($product_image['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($product_image["name"]);
            if (move_uploaded_file($product_image["tmp_name"], $target_file)) {
                // Update product image path in database
                $update_sql = "UPDATE products SET image = '$target_file' WHERE id = " . $conn->insert_id;
                $conn->query($update_sql);
            }
        }
        // Redirect or display success message
        header("Location: products_list.php");
        exit();
    } else {
        // Handle error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}