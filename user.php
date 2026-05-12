<?php
require_once 'config.php';

class User {
    // Properties
    public ?int $id;
    public string $username;
    public ?string $email;

    // Constructor to initialize a user object
    public function __construct(?int $id, string $username, ?string $email) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * Find user by Email
     * Returns a User object or null
     */
    public static function findByEmail(string $email) {
        global $pdo; 
        
        // 1. Prepare the statement
        $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE email = ? LIMIT 1");
        
        // 2. Execute with the provided email
        $stmt->execute([$email]);
        
        // 3. Fetch the data as an associative array
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Return a new instance of this class
            return new self($data['id'], $data['username'], $data['email']);
        }
        return null;
    }

    /**
     * Find user by ID
     * Returns a User object or null
     */
    public static function findById(int $id) {
        global $pdo;
        
        $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Using 'new self' is better practice than 'new User' inside the class
            return new self($data['id'], $data['username'], $data['email']);
        }
        return null;
    }
}
?>