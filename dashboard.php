<?php
require_once 'User.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user = User::findById($_SESSION['user_id']);
if (!$user) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>Welcome, <?php echo htmlspecialchars($user->username); ?>!</h1>

    <p>User ID: <?php echo $user->id; ?></p>

    <p>Email: <?php echo htmlspecialchars($user->email); ?></p>

    <br>

    <a href="logout.php">Logout</a>

</body>
</html>