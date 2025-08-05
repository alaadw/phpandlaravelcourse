<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection       
$title = "Edit Product"; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure    
require 'includes/menu.php'; // Include navbar file for navigation
// Check if product ID is provided
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    // Fetch product details from database
    $sql = "SELECT * FROM products WHERE id = {$productId}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product= $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>
<form action="action_edit_product.php" method="post" enctype="multipart/form-data" class="container mt-5">
    <h2>Edit Product</h2>
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product['image']); ?>">
    <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    </div>  
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <?php
            // Fetch categories from database
            $categorySql = "SELECT * FROM categories ORDER BY name";
            $categoryResult = $conn->query($categorySql);
            while ($category = $categoryResult->fetch_assoc()) {
                $selected = ($product['category_id'] == $category['id']) ? 'selected' : '';
                echo "<option value='{$category['id']}' {$selected}>" . htmlspecialchars($category['name']) . "</option>";
            }
            ?>
        </select>
    </div>      
    <div class="mb-3">
        <label for="product_description" class="form-label">Product Description</label>
        <textarea class="form-control" id="product_description" name="product_description"><?php echo htmlspecialchars($product['description']); ?></textarea>
    </div>      
            
    <div class="mb-3">
        <label for="product_price" class="form-label">Product Price</label>
        <input type="number" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
    </div>
    <div class="mb-3">  
        <label for="product_image" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="product_image" name="product_image">
        <?php if (!empty($product['image'])): ?>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="featured" class="form-label">Product Status</label>
        <input type="checkbox" id="featured" name="featured" value="1" <?php echo ($product['featured'] == 1) ? 'checked' : ''; ?>>
        <label for="featured" class="form-check-label">Featured</label>
    </div>
        <!-- album or product gallery -->
    <div class="mb-3">
        <label for="product_gallery" class="form-label">Product Gallery</label>
        <input type="file" class="form-control" id="product_gallery" name="product_gallery[]" multiple>
    </div>
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
<div class="container mt-5">
    <h2>Product Gallery</h2>
    <?php
    // Fetch product gallery images
    $gallerySql = "SELECT * FROM product_gallery WHERE product_id = {$productId}";
    $galleryResult = $conn->query($gallerySql);
    if ($galleryResult->num_rows > 0) {
        echo '<div class="row">';
        while ($image = $galleryResult->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4" id="gallery-image-' . $image['id'] . '">';
            echo '<img src="/ourproject/' . htmlspecialchars($image['image_path']) . '" class="img-fluid" style="min-width:100px;    min-height: 200px;" alt="Product Image">';
            echo '<br/><a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_product_image_gallery(' . $image['id'] . ')">Delete</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "<p>No images found in the gallery.</p>";
    }
    ?></div>
<?php
require 'includes/footer.php'; // Include footer file for closing HTML tags
?>
