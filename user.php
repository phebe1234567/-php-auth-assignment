<?php
require_once 'config.php';

class User {

    public $id;
    public $username;
    public $email;

    public function __construct($id, $username, $email) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    public static function findByEmail($email) {
        global $pdo; // Use the connection from config.php
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email']);
        }
        return null;
    }


    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new User($data['id'], $data['username'], $data['email']);
        }
        return null;
    }
}
?>