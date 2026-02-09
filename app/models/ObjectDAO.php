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
        $stmt = $db->prepare("SELECT * FROM object WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $category]);
        return $stmt->fetchAll();
    }

    public function createObject($userId, $name, $description, $categoryId, $price) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO object (name, description, category_id, price, owner_id) VALUES (:name, :description, :category_id, :price, :owner_id)");
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'category_id' => $categoryId,
            'price' => $price,
            'owner_id' => $userId
        ]);
    }

    public function updateObjectStatus($id, $status) {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE object SET status = :status WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function updateObjectOwner($id, $newOwnerId) {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE object SET owner_id = :owner_id WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'owner_id' => $newOwnerId
        ]);
    }

    public function searchObjects($searchTerm) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM object WHERE name LIKE :search OR description LIKE :search");
        $stmt->execute(['search' => '%' . $searchTerm . '%']);
        return $stmt->fetchAll();
    }

}