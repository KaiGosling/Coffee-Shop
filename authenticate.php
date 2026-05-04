<?php
session_start();
$conn = new mysqli("localhost", "root", "", "coffeeshop_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // IMPORTANT: column is `name`, NOT `username`
    $stmt = $conn->prepare("SELECT * FROM user_admin_tb WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {

            // LOGIN SUCCESS
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];

            header("Location: dashboard.php");
            exit;

        } else {
            header("Location: login.php?msg=Invalid password");
            exit;
        }

    } else {
        header("Location: login.php?msg=User not found");
        exit;
    }
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
        <div class="msg"><?= $message ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

    <a href="register.php">Don't have an account? Register</a>
</div>

</body>
</html>
