<?php 
namespace App\Models;
use Flight;
class ExchangeDAO {
    public function createExchange($userId, $objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO exchanges (user_id, object_id) VALUES (:user_id, :object_id)");
        return $stmt->execute([
            'user_id' => $userId,
            'object_id' => $objectId
        ]);
    }

    public function getExchangesByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchanges WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getExchangesByObjectId($objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchanges WHERE object_id = :object_id");
        $stmt->execute(['object_id' => $objectId]);
        return $stmt->fetchAll();
    }

    public function deleteExchange($id) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM exchanges WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getAllExchanges() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM exchanges");
        return $stmt->fetchAll();
    }

    public function getExchangeById($id) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchanges WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
}