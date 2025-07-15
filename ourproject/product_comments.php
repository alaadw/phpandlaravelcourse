<?php
require 'includes/main.php'; // Include main file for session management and database connection
require 'config/database.php'; // Include database connection
$title = $lang['comments']; // Set the title for the page
require 'includes/header.php'; // Include header file for HTML structure
require 'includes/menu.php'; // Include navbar file for navigation
$sql = "SELECT product_comments.*,products.name as product_name FROM product_comments left join 
products on product_comments.product_id = products.id ORDER BY product_comments.id DESC";
$result = $conn->query($sql);
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo $lang['id']; ?></th>
            <th><?php echo $lang['product_name']; ?></th>
            <th><?php echo $lang['user_name']; ?></th>
            <th><?php echo $lang['comment']; ?></th>
            <th><?php echo $lang['created_at']; ?></th>
            <th><?php echo $lang['actions']; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <form action="action_delete_comment.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm"><?php echo $lang['delete']; ?></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6"><?php echo $lang['no_comments_found']; ?></td></tr>
        <?php endif; ?>
    </tbody>
</table>
