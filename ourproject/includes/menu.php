 
<div class="navbar">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="users_list.php">
           <?php echo $lang['users']; ?></a></li>
            
        </a></li>
        <li class="nav-item"><a class="nav-link" href="categories_list.php">
            <?php echo $lang['categories']; ?>
        </a></li>
        <li class="nav-item"><a class="nav-link" href="add_category.php">
            <?php echo $lang['add_category']; ?></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="add_product.php">
            <?php echo $lang['add_product']; ?></a></li>
        <li class="nav-item"><a class="nav-link" href="products_list.php">
            <?php echo $lang['products']; ?></a></li>
        <li class="nav-item"><a class="nav-link" href="product_comments.php">
            <?php echo $lang['comments']; ?></a></li>       
        <li class="nav-item"><a class="nav-link" href="logout.php">
            <?php echo $lang['logout']; ?></a></li>
        <li class="nav-item">
            <?php if($language == 'en'){ ?>
                <a href="?lang=ar" class="nav-link">عربي</a>
            <?php } else { ?>
                <a href="?lang=en" class="nav-link">English</a>
            <?php } ?>
        </li>
    </ul>
</div>
 