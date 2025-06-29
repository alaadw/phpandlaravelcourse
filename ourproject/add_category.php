<?php
require 'includes/main.php'; // Include main file for session management and database connection
$title = "Add Category"; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure
require 'includes/menu.php'; // Include navbar file for navigation
?>
<form action="action_add_category.php" method="post" class="container mt-5">
    <h2>Add Category</h2>
    <div class="mb-3">
        <label for="category_name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" required>
    </div>
    <div class="mb-3">
        <label for="category_description" class="form-label">Category Description</label>
        <textarea class="form-control" id="category_description" name="category_description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>