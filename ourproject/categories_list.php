<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = "Categories List"; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure
require 'includes/menu.php'; // Include navbar file for navigation  
// Fetch categories from database
$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = $conn->query($sql);       

?>
<div class="container mt-5">    
    <h2>Categories List</h2>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                echo "<td>";
                echo "<a href='edit_category.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> | ";   
                echo "<a href='delete_category.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No categories found.</td></tr>";
        }
        ?>  
    </table>
</div>  
<?php
require 'includes/footer.php'; // Include footer file for closing HTML tags
?>