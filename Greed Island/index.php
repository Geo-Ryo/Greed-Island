<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load JSON file
    $usersData = file_get_contents('users.json');
    $users = json_decode($usersData, true);

    // Check if username exists in users JSON
    if (array_key_exists($username, $users)) {
        // Check if password matches
        if ($users[$username]['password'] === $password) {
            // Redirect to home.html
            header("Location: pg/home.php");
            exit;
        } else {
            $errorMessage = "Incorrect password";
        }
    } else {
        $errorMessage = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/icons/hunter-x-hunter.ico">
    <script src="js/index.js"></script>
    <title>Greed Island - Login</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($errorMessage)): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" autocomplete="off" required><br>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required><br>
            <input type="submit" name="submit" value="Login">
            <p>Dont't have an account?</p>
            <a href="pg/signup.php">Create one.</a>
        </form>
    </div>
</body>
</html>