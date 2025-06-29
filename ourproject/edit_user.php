<?php
require 'includes/main.php'; // Include header file for HTML structure

require 'config/database.php'; // Include database connection
$title = "User Edit"; // Set the title for the page 
require 'includes/header.php'; // Include header file for HTML structure
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
   
    // Fetch user data from database
    $sql = "SELECT * FROM users WHERE id = $user_id";   
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        require 'includes/menu.php'; // Include navbar file for navigation
        ?>

        <form action="action_edit_user.php" method="post" enctype="multipart/form-data" class="container mt-5">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="mb-3">
                <h2>Edit User</h2>
            </div>
            <div class="mb-3">
                <div class="form-group">
                <div>  
                  <label for="username">Username:</label>
                </div>
                <div>
                   <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
              </div>  
            </div>
            <div class="mb-3">
                <div class="form-group">
                <div>           
                <label for="email">Email:</label>
                </div>
                <div>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>  
                </div>
            </div>
            <br> <br/>
            <label for="profile_picture">Profile Picture:</label>
            <?php if (!empty($user['image'])): ?>
                <img src="uploads/<?php echo $user['image']; ?>" alt="Profile Picture" width="50" height="50">
            <?php endif; ?>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update User</button>
            </div>
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


require 'includes/footer.php'; // Include footer file for closing HTML tags