<?php
require_once 'config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
       $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if (empty($username)) {
        $errors[] = "Username is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

   
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }


    $checkQuery = "SELECT * FROM users
                   WHERE username = :username
                   OR email = :email";

    $stmt = $pdo->prepare($checkQuery);

    $stmt->execute([
        ':username' => $username,
        ':email' => $email
    ]);

    if ($stmt->rowCount() > 0) {
        $errors[] = "Username or email already exists";
    }


    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $insertStmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        
        try {
            $insertStmt->execute([$username, $email, $hashedPassword]);
            
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>   
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if (!empty($errors)): ?>

       
    <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars ($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
      <?php endif; ?>
      <form action="register.php" method="POST">

        <label>Username:</label><br>
        <input type="text" name="username"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Register</button>

    </form>
</body>
</html>