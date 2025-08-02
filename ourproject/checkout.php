<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
require 'views/header.php'; // Include header file for common operations
require 'views/menu.php'; // Include menu file for navigation

?>
<form action="action_save_shipping.php" method="post" class="container mt-5">
    <h2><?php echo $lang['checkout']; ?></h2>
    <div class="mb-3">
        <label for="shipping_address" class="form-label"><?php echo $lang['shipping_address']; ?></label>
        <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label"><?php echo $lang['phone_number']; ?></label>
        <input type="telephone" class="form-control" id="phone_number" name="phone_number" required>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $lang['confirm_order']; ?></button>
</form>
