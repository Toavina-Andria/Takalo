<?php
namespace App\Models;
use Flight;

class ObjectDAO
{
    public static function getObjectById($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }


    public static function deleteObject($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM objects WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function updateObject($id, $name, $description)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE objects SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description
        ]);
    }

    public static function getAllObjects()
    {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM objects");
        return $stmt->fetchAll();
    }

    public static function getObjectsByUserId($userId)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM objects WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public static function getObjectsByCategory($category)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM object WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $category]);
        return $stmt->fetchAll();
    }

    public static function createObject($userId, $name, $description, $categoryId, $price)
    {
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

    public static function updateObjectStatus($id, $status)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE object SET status = :status WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public static function updateObjectOwner($id, $newOwnerId)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE object SET owner_id = :owner_id WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'owner_id' => $newOwnerId
        ]);
    }

    public static function searchObjects($searchTerm)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM object WHERE name LIKE :search OR description LIKE :search");
        $stmt->execute(['search' => '%' . $searchTerm . '%']);
        return $stmt->fetchAll();
    }

}