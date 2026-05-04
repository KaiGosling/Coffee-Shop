<?php
session_start();
$message = "";

// Optional: show a message if redirected from register.php
if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <!-- Dark overlay -->
    <div class="shader"></div>

    <!-- Content above overlay -->
    <div class="logointromod">
        <img class="logointro" src="logo2.png">


<div class="register-box">
    <h2 class="register-title">Login</h2>

    <?php if ($message): ?>
        <div class="msg" ><?= $message ?></div>
    <?php endif; ?>

    <form action="authenticate.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

    <a href="register.php">Don't have an account? Register</a>
</div>
</div></div>
</body>
</html>
