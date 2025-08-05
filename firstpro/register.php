<html>
<head>
    <title>Register</title> 
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .success{
            color: #fff;
            background-color: #1d6f20;
            padding: 19px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
        }
        #username{
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input
        {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

</head>
<body>
    <?php
    if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
        echo "<p class='success'>Registration successful!</p>";
    }
    if(isset($_GET['action']) && !empty($_GET['action'])  ) {
        $name = $_GET['name'];
        echo "<p class='success'>You are welcome ".$name."</p>";
    }
    ?>
    <form action="action_register.php" method="post">
        <h2>Register</h2>
        <label for="username">Username:</label>
        <input type="text"  id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <!--<label> Age</label>
        <input type="number" name="age" min="18" max="60" required><br><br>-->
        <!-- <label>Age:</label>
        <select name="age" required>
            <option value="">Select Age</option>
            <?php
            for ($i = 18; $i <= 60; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>-->
        <label for="age">Age:</label>
        <select name="">
            <option value="">Select Age</option>
            <?php
             $ages = range(20, 60);
            foreach ($ages as $i) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register</button>   
</body>
</html>