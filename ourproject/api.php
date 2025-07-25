<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection

$endpoint = $_GET['endpoint'] ?? '';
switch ($endpoint) {
    case 'products':
        // Handle product-related requests
       // $sql = "SELECT * FROM products";
       $sql = "SELECT products.*,categories.name as category_name FROM `products` 
       left JOIN categories on products.category_id = categories.id order by products.id asc;
";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[$row['id']] = $row;
            }
           
            // Add additional fields if necessary
            $imageSql =  "SELECT * FROM product_gallery WHERE product_id IN (" . implode(',', array_keys($products)) . ")";
            $imageResult = $conn->query($imageSql);
            if ($imageResult->num_rows > 0) {
                while ($imageRow = $imageResult->fetch_assoc()) {
                    $products[$imageRow['product_id']]['images'][] = $imageRow;
                }
            }
             
            // Return products as JSON
            echo json_encode($products);
        } else {
            echo json_encode([]);
        }
        break;
    case 'categories':
        // Handle category-related requests
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        break;
}