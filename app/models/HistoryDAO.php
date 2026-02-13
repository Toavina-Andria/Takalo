<?php
namespace App\Models;
use Flight;

class HistoryDAO {
    public static function getHistoryByUserId($oldUserId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE old_user_id = :old_user_id ORDER BY created_at DESC");
        $stmt->execute(['old_user_id' => $oldUserId]);
        return $stmt->fetchAll();
    }

    public static function addHistoryEntry($oldUserId, $oldObjectId) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO history (old_user_id, old_object_id, created_at) VALUES (:old_user_id, :old_object_id, NOW())");
        return $stmt->execute([
            'old_user_id' => $oldUserId,
            'old_object_id' => $oldObjectId
        ]);
    }

    public static function deleteHistoryByUserId($oldUserId) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM history WHERE old_user_id = :old_user_id");
        return $stmt->execute(['old_user_id' => $oldUserId]);
    }

    public static function getHistoryByObjectId($oldObjectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE old_object_id = :old_object_id ORDER BY created_at DESC");
        $stmt->execute(['old_object_id' => $oldObjectId]);
        return $stmt->fetchAll();
    }

    public static function getAllHistory() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM history ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public static function getHistoryByUserIdAndObjectId($oldUserId, $oldObjectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE old_user_id = :old_user_id AND old_object_id = :old_object_id ORDER BY created_at DESC");
        $stmt->execute([
            'old_user_id' => $oldUserId,
            'old_object_id' => $oldObjectId
        ]);
        return $stmt->fetchAll();
    }


    public static function getRecentHistory($limit = 10) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history ORDER BY created_at DESC LIMIT :limit");
        $stmt->execute(['limit' => $limit]);
        return $stmt->fetchAll();
    }
}