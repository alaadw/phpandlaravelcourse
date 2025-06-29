<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = "Add Product"; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure    
require 'includes/menu.php'; // Include navbar file for navigation
?>
<form action="action_add_product.php" method="post" enctype="multipart/form-data" class="container mt-5">
    <h2>Add Product</h2>
    <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            <?php
            // Fetch categories from database
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                }
            }
            ?>
        </select>
    </div>  
    <div class="mb-3">
        <label for="product_description" class="form-label">Product Description</label>
        <textarea class="form-control" id="product_description" name="product_description"></textarea>
    </div>  
    <div class="mb-3">
        <label for="product_price" class="form-label">Product Price</label>
        <input type="number" class="form-control" id="product_price" name="product_price" step="0.01" required>
    </div>  
    <div class="mb-3">
        <label for="product_image" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/*">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Add Product</button>

    </div>
</form>