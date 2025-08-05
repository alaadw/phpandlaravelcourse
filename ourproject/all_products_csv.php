<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = "All Products"; // Set the title for the page

if(isset($_GET['csv']) && $_GET['csv'] == 'true') {
    //tell the browser to download the file as a CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="products_example.csv"');
    //tell the brower that the file is a CSV
    //fopen a file pointer to output stream
    $output = fopen('php://output', 'w');
    //fputcsv writes a line to the output stream
    fputcsv($output, ['ID', 'Name', 'Category', 'Price', 'Image']);

    $sql = "SELECT p.id, p.name, c.name as category_name, p.price, p.image 
    FROM products p JOIN categories c ON p.category_id = c.id 
    ORDER BY p.name ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            fputcsv($output, [$row['id'], $row['name'], $row['category_name'], $row['price'], $row['image']]);
        }
    }
    
    fclose($output);
    exit();

}