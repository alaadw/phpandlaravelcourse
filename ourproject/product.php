<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
include 'views/header.php'; // Include header file for common operations
require 'views/menu.php'; // Include menu file for navigation
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Get product ID from URL, default to 0 if not set
$product = "select * from products where id = {$id} limit 1";
$result = $conn->query($product);
if ($result->num_rows > 0) {
    $productData = $result->fetch_assoc();
} else {
    // Redirect to home page if product not found
    header("Location: index.php?error=Product not found");
    exit();
}

 
?>
<style>
    .blackback {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 10px;
    }
    .blackback a{
      text-decoration: none;
      color: white;
    }
</style>
<script>
    function addToCart(productId) {
         //confirm returns true or false
    // If user confirms, proceed with deletion
    // Use fetch API to send a POST request to addto_cart.php
    // This allows us to add the product to the cart without reloading the page
    fetch('addto_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + productId 
    })
    .then(res => { 
        if (res.ok) {
           // var itemsSum = document.getElementById('sumofitems');
           // var currentCount = parseInt(itemsSum.textContent) || 0; // Get current cart count
           // itemsSum.textContent = currentCount + 1; // Update cart count
           // another way
           var itemSum  = document.getElementById('sumofitems').innerText;
              var currentCount = parseInt(itemSum) || 0; // Get current cart count
              document.getElementById('sumofitems').innerText = currentCount + 1; // Update cart count
            document.getElementById('product-' + productId).innerHTML = '<p>Product added to cart successfully!</p>';
        } else {
            alert('Error adding to cart');
        }
    })
    .catch(() => alert('Error adding to cart'));
    }
</script>
<div class="container mt-5">
 
    <?php 
      if (isset($productData)) {
        $productName = htmlspecialchars($productData['name']);
        $productImage = htmlspecialchars($productData['image']);
        if (empty($productImage)) {
            $productImage = 'images/default-product.png'; // Default image if none is set
        }
    } 
    ?>
    <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>"></div>
                    <div class="col-md-6">
                        <div class="small mb-1"><?php echo $productData['id']; ?></div>
                        <h1 class="display-5 fw-bolder"> <?php echo strtolower($productName); ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">
                              <?php echo 'JOD' . ($productData['price'] + 10); ?></span>
                            <span><?php echo 'JOD' . $productData['price']; ?></span>
                        </div>       /
                        <p class="lead">
                          <?php 
                        echo str_replace ('/', ' / ' ,mb_substr(htmlspecialchars($productData['description']), 0, 100)); ?>
                        </p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem">
                            <div id="product-<?php echo $productData['id']; ?>" class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg">
                              <a href="javascript:void(0);" class="btn btn-primary" onclick="addToCart(<?php echo $productData['id']; ?>)"><i class="bi-cart-fill me-1"></i>Add to Cart</a>

                          </div>  
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
       
      <!-- product Comments -->
       <h2 class="fw-bolder mb-4" id="comments">Product Comments</h2>
       <?php
       //INSERT INTO product_comments (product_id, user_name, comment) VALUES ('16', 'erdwerwe rwete', 'ertertret')
         $commentsQuery = "SELECT * FROM product_comments WHERE product_id = {$productData['id']} ORDER BY created_at DESC";
            $commentsResult = $conn->query($commentsQuery);
            if ($commentsResult->num_rows > 0) {
                while ($comment = $commentsResult->fetch_assoc()) {
                    echo "<div class='mb-3'>";
                    echo "<strong>" . htmlspecialchars($comment['user_name']) . ":</strong> ";
                    echo htmlspecialchars($comment['comment']);
                    echo "<br><small class='text-muted'>" . date('Y-m-d H:i:s', strtotime($comment['created_at'])) . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No comments yet.</p>";
            }
        ?>
       <form action ="action_save_comment.php" method="post" id="commentForm">
       
         <input type="hidden" name="product_id" value="<?php echo $productData['id']; ?>">
        <div>
            <input type="text" class="form-control mb-3" name="name" placeholder="Your Name" required>
        </div>     
       <div class="mb-4">
           <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Leave a comment..."></textarea>
       </div>
       <div class="d-flex">
           <button class="btn btn-primary" id="submitComment">Submit</button>
       </div>
         </form>
      <!-- recent products  -->
      
     <?php  
       $recentProducts = "select * from products where
        featured = 0 and category_id = {$productData['category_id']} 
        and id <> {$productData['id']}
        order by id desc limit 4 ";
     
       $result = $conn->query($recentProducts);
      ?>
      <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   <?php 
     foreach ($result as $row) {
        $productName = htmlspecialchars($row['name']);
        $productImage = htmlspecialchars($row['image']);
        if (empty($productImage)) {
            $productImage = 'images/default-product.png'; // Default image if none is set
        }
    ?>
                <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" style="max-height: 200px; object-fit: cover;" src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $productName; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $row['price']; ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="product.php?id=<?php echo $row['id']; ?>">View options</a></div>
                            </div>
                        </div>
                    </div>
                     
                
            
            <?php } // end of foreach ?>
            </div>
                </div>
        </section>
 
</div>