<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = "Products List"; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure
require 'includes/menu.php'; // Include navbar file for navigation  

function getCategoryName($categoryId) {
    global $conn;
    $sql = "SELECT name FROM categories WHERE id = {$categoryId}";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
        return htmlspecialchars($row['name']);
    }
    return 'Unknown Category';
}
/** fetch json from other website  */
$contextOptions = [
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ],
];

$json = file_get_contents("https://fakestoreapi.com/products", false, stream_context_create($contextOptions));
//https://fakestoreapi.com/products
//$json = file_get_contents('http://fakestoreapi.com/products');
// Decode JSON data
$products = json_decode($json, true);
foreach($products as $product){
    //echo $product['title']  . "<br>";
    //price description  image
   // echo $product['price'] . "<br>";
   // echo $product['description'] . "<br>";
   // echo '<img src="'.$product['image']. '"/>' . "<br>";
    $title = $conn->real_escape_string($product['title']);
    $desc = $conn->real_escape_string($product['description']);
    $price = $conn->real_escape_string($product['price']);
    $image = $conn->real_escape_string($product['image']);
    
    // Prepare and execute SQL statement to insert product
   $sql  = "INSERT INTO products (name, category_id, description, price, featured, 
   image)
    VALUES ('{$title}', 3, '{$desc}', '{$price}', 10, '{$image}')";
    if ($conn->query($sql) === TRUE) {
        echo "New product created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
die();
// Fetch categories from database
  
$sql = "SELECT products.*,categories.name as catname FROM `products` left JOIN categories on products.category_id = categories.id;
";
$result = $conn->query($sql);
?>
<form action="mass_delete_action_products.php" method="post">
<div class="container mt-5">
    <h2><?php echo $title; ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['catname']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo ($row['featured'] == 1) ? 'Yes' : 'No'; ?> </td>
                    <td>
                        <?php if (!empty($row['image'])) {?>
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100">
                        <?php }?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        <input type="checkbox" name="ides[]" value="<?php echo $row['id']; ?>" class="form-check-input">
                        
                    </td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <input type="submit" name="mass_delete" value="Mass Delete" class="btn btn-danger">
                        </form>
</div>
<?php
require 'includes/footer.php'; // Include footer file for closing HTML tags     
?>
