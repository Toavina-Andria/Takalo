<?php
namespace App\Models;
use Flight;

class HistoryDAO {
    public function getHistoryByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function addHistoryEntry($userId, $objectId, $action) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO history (user_id, object_id, action) VALUES (:user_id, :object_id, :action)");
        return $stmt->execute([
            'user_id' => $userId,
            'object_id' => $objectId,
            'action' => $action
        ]);
    }

    public function deleteHistoryByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM history WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $userId]);
    }

    public function getHistoryByObjectId($objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE object_id = :object_id");
        $stmt->execute(['object_id' => $objectId]);
        return $stmt->fetchAll();
    }

    public function getAllHistory() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM history");
        return $stmt->fetchAll();
    }

    public function getHistoryByUserIdAndObjectId($userId, $objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE user_id = :user_id AND object_id = :object_id");
        $stmt->execute([
            'user_id' => $userId,
            'object_id' => $objectId
        ]);
        return $stmt->fetchAll();
    }
}