<?php
require 'config/database.php'; // Include database connection
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
   
    // Fetch user data from database
    $sql = "SELECT * FROM users WHERE id = $user_id";   
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        ?>
        <form action="action_edit_user.php" method="post" enctype="multipart/form-data">
            <input type="text" name="id" value="<?php echo $user['id']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <br> <br/>
            <label for="profile_picture">Profile Picture:</label>
            <?php if (!empty($user['image'])): ?>
                <img src="uploads/<?php echo $user['image']; ?>" alt="Profile Picture" width="50" height="50">
            <?php endif; ?>
            <input type="file" name="profile_picture" id="profile_picture">
            <br>
            <button type="submit">Update User</button>
        </form> 
       <?php 
        die();
    } else {
        header("Location: users_list.php?msg=User not found.");
        exit();
    }
} else {
    header("Location: users_list.php?msg=Invalid user ID.");
}