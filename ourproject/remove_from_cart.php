<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$id = $_REQUEST['id'] ?? null;
if ($id) {
    $sql ="delete from cart where id = $id and user_id = {$_SESSION['user']['id']}";
   
    $result = $conn->query($sql);
    echo json_encode(['success' => $result]);
    
}
    ?>