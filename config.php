<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'php_auth_db');
define('DB_USER', 'root'); 
define('DB_PASS', '');     


try {
   
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
   
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    
   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             echo "Database connected successfully";
    
} catch (PDOException $e) {
   
    die("Database connection failed: " . $e->getMessage());
}
?>