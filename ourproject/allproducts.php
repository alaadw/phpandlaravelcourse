<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
require 'views/header.php'; // Include header file for common operations
require 'views/menu.php'; // Include menu file for navigation
require 'includes/functions.php'; // Include functions file for utility functions
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $categoryId = (int)$_GET['id'];
    $addedCondition = " and category_id = $categoryId";
} else {
    $addedCondition = '';

}
$featuredProducts = "select * from products where featured = 1 $addedCondition order by id desc limit 3 ";
$result = $conn->query($featuredProducts);
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
<div class="container mt-5">
<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
    <?php 
     foreach ($result as $row) {
        $productName = htmlspecialchars($row['name']);
        $productImage = htmlspecialchars($row['image']);
        if (empty($productImage)) {
            $productImage = 'images/default-product.png'; // Default image if none is set
        }
    ?>
     <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('<?php echo $productImage ?>');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold blackback"><?php echo $productName; ?></h2>
            <ul class="d-flex list-unstyled mt-auto">
              <li class="me-auto">
                <img src="<?php echo $productImage; ?>" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
              </li>
              <li class="d-flex align-items-center me-3">
                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"></use></svg>
                <small>Earth</small>
              </li>
              <li class="d-flex align-items-center">
                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"></use></svg>
                <small><?php  echo getDateDifference($row['created_at']); ?></small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    <?php } // end of while ?>
      
    </div>
    </div>  
      <!-- recent products  -->
       <h2 class="p-3" style="padding-left: 10px"> Recent Products  </h2>
     <?php  
       $recentProducts = "select * from products where featured = 0  order by id desc limit 12 ";
       $result = $conn->query($recentProducts);
      ?>
  <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
    <?php 
     foreach ($result as $row) {
        $productName = htmlspecialchars($row['name']);
        $productImage = htmlspecialchars($row['image']);
        if (empty($productImage)) {
            $productImage = 'images/default-product.png'; // Default image if none is set
        }
    ?>
     <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('<?php echo $productImage ?>');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold blackback">
             <a href="product.php?id=<?php echo $row['id']; ?>"><?php echo $productName; ?></a>
            </h2>
            <ul class="d-flex list-unstyled mt-auto">
              <li class="me-auto">
                <a href="product.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $productImage; ?>" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white"></a>
              </li>
              <li class="d-flex align-items-center me-3">
                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"></use></svg>
                <small>Earth</small>
              </li>
              <li class="d-flex align-items-center">
                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"></use></svg>
                <small><?php  echo getDateDifference($row['created_at']); ?></small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    <?php } // end of while ?>
      
    </div>
    </div> 