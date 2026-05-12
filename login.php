<?php
require_once 'config.php';
session_start(); 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
    
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
           
            $error = "Invalid credentials.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php if (!empty($error)): ?>

    <div class="error">
        <p><?php echo $error; ?></p>
    </div>

   <?php endif; ?>
    <form action="login.php" method="POST">

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">
        Login
    </button>
</body>
</html>