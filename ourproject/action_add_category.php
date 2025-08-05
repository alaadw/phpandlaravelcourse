<?php
require 'config/database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $_POST['category_name'];
    $category_description = $_POST['category_description'];

    // Insert category into database
    $sql = "INSERT INTO categories (name, description) VALUES ('$category_name', '$category_description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: categories_list.php?msg=Category added successfully.");
        exit();
    } else {
        header("Location: add_category.php?error=Error adding category.");
        exit();
    }
}

