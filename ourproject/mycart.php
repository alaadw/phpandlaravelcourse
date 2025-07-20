<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
require 'views/header.php'; // Include header file for common operations
require 'views/menu.php'; // Include menu file for navigation
$userId = isset($_SESSION['user']['id']) ? intval($_SESSION['user']['id']) : 0; // Get user ID from session
if ($userId > 0) {
    $cartQuery = "SELECT p.id, p.name, p.price, p.image 
    FROM cart c 
    JOIN products p ON c.product_id = p.id WHERE c.user_id = $userId";
    $result = $conn->query($cartQuery);
    
    if ($result->num_rows > 0) {
        $cartItems = $result->fetch_all(MYSQLI_ASSOC);
        
    } else {
        $cartItems = [];
    }
} else {
    $cartItems = [];
}
?>
<div class="container mt-5">
    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold blackback">
        <?php echo $lang['my_cart']; ?>
    </h2>
    <div class="row">
        <?php if (count($cartItems) > 0): ?>
            <?php foreach ($cartItems as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['price']); ?> <?php echo $lang['currency']; ?></p>
                            <button class="btn btn-danger" onclick="removeFromCart(<?php echo $item['id']; ?>)"><?php echo $lang['remove_from_cart']; ?></button>
            </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p><?php echo $lang['no_items_in_cart']; ?></p>
        <?php endif; ?>
    </div>
</div>