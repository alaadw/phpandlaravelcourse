<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $shippingAddress = $_POST['shipping_address'] ?? '';
    $phoneNumber = $_POST['phone_number'] ?? '';

    // Validate and process the data
    if(!empty($shippingAddress) && !empty($phoneNumber)) {
        $userId = $_SESSION['user']['id'] ?? 0;
        if($userId > 0) {
            // Save the shipping information to the database
            $sql = "insert into shipping (user_id,shipping_address, phone_number)
             values ('{$userId}', '{$shippingAddress}', '{$phoneNumber}')";
            if($conn->query($sql)) {
                // Redirect to a success page or display a success message
                
                header('Location: mycart.php?success=Checkout successful');
                exit();
        }
    }
  }
}