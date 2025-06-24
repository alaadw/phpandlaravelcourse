<?php
require 'config/database.php'; // Include database connection
$sql = "SELECT * FROM users";
$result = $conn->query($sql);   
?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Profile Picture</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            if(!empty($row['image'])) {
                echo "<td><img src='uploads/" . $row['image'] . "' alt='Profile Picture' width='50' height='50'></td>";
            } else {
                echo "<td>No Image</td>";
            }
            echo "<td>";
            echo "<a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | ";   
            echo "<a href='delete_user.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found.</td></tr>";
    }
    ?>     
