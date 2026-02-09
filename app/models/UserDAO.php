<?php 
namespace App\Models;

use Flight;

class UserDAO {
    
    public function getUserByEmail($email) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function createUser($name, $email, $password) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function getUserById($id) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function deleteUser($id) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function updateUser($id, $name, $email) {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email
        ]);
    }

    public function verifyPassword($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUsers() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function getUserObjects($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

}