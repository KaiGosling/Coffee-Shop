<?php
$conn = new mysqli("localhost", "root", "", "coffeeshop_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $role = "customer"; // ✅ AUTO ROLE

    // ✅ VALIDATION (fixed flow)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address";

    } elseif ($password !== $confirm) {
        $message = "Passwords do not match";

    } else {

        // ✅ Check username
        $checkUser = $conn->prepare("SELECT id FROM user_admin_tb WHERE name = ?");
        $checkUser->bind_param("s", $username);
        $checkUser->execute();
        $checkUser->store_result();

        // ✅ Check email
        $checkEmail = $conn->prepare("SELECT id FROM user_admin_tb WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkUser->num_rows > 0) {
            $message = "Username already exists";

        } elseif ($checkEmail->num_rows > 0) {
            $message = "Email already registered";

        } else {
            // ✅ Hash password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // ✅ INSERT with ROLE
            $stmt = $conn->prepare(
                "INSERT INTO user_admin_tb (name, email, password, role) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $username, $email, $hashed, $role);

            if ($stmt->execute()) {
                header("Location: login.php?msg=Registration successful, please login");
                exit;
            } else {
                $message = "Registration failed";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="shader"></div>

<div class="logointromod">
    <img class="logointro" src="logo2.png">

    <div class="register-box">
        <h2 class="register-title">Register</h2>

        <?php if ($message): ?>
            <div class="msg"><?= $message ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" value="Register">
        </form>

        <a href="login.php">Already have an account?</a>
    </div>
</div>

</body>
</html>