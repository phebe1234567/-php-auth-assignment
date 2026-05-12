<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<h1>Welcome to My PHP Auth System</h1>

<?php if (isset($_SESSION['user_id'])): ?>

    <p>You are logged in.</p>

    <a href="dashboard.php">Go to Dashboard</a><br>
    <a href="logout.php">Logout</a>

<?php else: ?>

    <a href="login.php">Login</a><br>
    <a href="register.php">Register</a>

<?php endif; ?>

</body>
</html>