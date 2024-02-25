<?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Load existing users JSON or create an empty array
            $usersData = file_get_contents('../users.json');
            $users = json_decode($usersData, true);
            if (!$users) {
                $users = [];
            }

            // Check if username already exists
            if (array_key_exists($username, $users)) {
                $errorMessage = "Username already exists";
            } else {
                // Add new user to users array
                $users[$username] = ['email' => $email, 'password' => $password];
                
                // Save updated users array back to JSON file
                file_put_contents('users.json', json_encode($users));

                // Redirect to home.html or any other page
                header("Location: pg/home.php");
                exit;
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="shortcut icon" href="../img/icons/hunter-x-hunter.ico">
    <script src="js/index.js"></script>
    <title>Greed Island - Sign Up</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <?php if (isset($errorMessage)): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" autocomplete="off" required><br>
            <input type="email" name="email" placeholder="Email" autocomplete="off" required><br>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required><br>
            <input type="submit" name="submit" value="Sign Up">
            <p>Already have an account?</p>
            <a href="../index.php">Login</a>
        </form>
    </div>
</body>
</html>
