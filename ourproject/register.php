 <form action="action_register.php" method="post" enctype="multipart/form-data">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text"  id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="profile_picture">Profile Picture:</label>
         <input type="file" id="profile_picture" name="profile_picture" accept="image/*"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
  
        <button type="submit">Register</button>
</form>      