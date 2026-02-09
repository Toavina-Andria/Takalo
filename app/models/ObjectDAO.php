<?php 
namespace App\Models;
use Flight;

class ObjectDAO {
    public function getObjectById($id) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public function deleteObject($id) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM objects WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function updateObject($id, $name, $description) {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE objects SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description
        ]);
    }

    public function getAllObjects() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM objects");
        return $stmt->fetchAll();
    }

    public function getObjectsByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getObjectsByCategory($category) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE category = :category");
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll();
    }

    
}