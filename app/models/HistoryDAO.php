<?php
namespace App\Models;
use Flight;

class HistoryDAO {
    public function getHistoryByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function addHistoryEntry($userId, $objectId, $action, $details = null) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO history (user_id, object_id, action, details) VALUES (:user_id, :object_id, :action, :details)");
        return $stmt->execute([
            'user_id' => $userId,
            'object_id' => $objectId,
            'action' => $action,
            'details' => $details
        ]);
    }

    public function deleteHistoryByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM history WHERE user_id = :user_id");
        return $stmt->execute(['user_id' => $userId]);
    }

    public function getHistoryByObjectId($objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE object_id = :object_id ORDER BY created_at DESC");
        $stmt->execute(['object_id' => $objectId]);
        return $stmt->fetchAll();
    }

    public function getAllHistory() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM history ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getHistoryByUserIdAndObjectId($userId, $objectId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history WHERE user_id = :user_id AND object_id = :object_id ORDER BY created_at DESC");
        $stmt->execute([
            'user_id' => $userId,
            'object_id' => $objectId
        ]);
        return $stmt->fetchAll();
    }

    public function addObjectCreationHistory($userId, $objectId) {
        return $this->addHistoryEntry($userId, $objectId, 'object_created');
    }

    public function addObjectDeletionHistory($userId, $objectId) {
        return $this->addHistoryEntry($userId, $objectId, 'object_deleted');
    }

    public function addObjectUpdateHistory($userId, $objectId) {
        return $this->addHistoryEntry($userId, $objectId, 'object_updated');
    }

    public function addExchangeRequestHistory($userId, $objectId, $exchangeId) {
        return $this->addHistoryEntry($userId, $objectId, 'exchange_requested', 'exchange_id:' . $exchangeId);
    }

    public function addExchangeAcceptedHistory($userId, $objectId, $exchangeId) {
        return $this->addHistoryEntry($userId, $objectId, 'exchange_accepted', 'exchange_id:' . $exchangeId);
    }

    public function addExchangeRejectedHistory($userId, $objectId, $exchangeId) {
        return $this->addHistoryEntry($userId, $objectId, 'exchange_rejected', 'exchange_id:' . $exchangeId);
    }

    public function addExchangeCancelledHistory($userId, $objectId, $exchangeId) {
        return $this->addHistoryEntry($userId, $objectId, 'exchange_cancelled', 'exchange_id:' . $exchangeId);
    }

    public function getRecentHistory($limit = 10) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM history ORDER BY created_at DESC LIMIT :limit");
        $stmt->execute(['limit' => $limit]);
        return $stmt->fetchAll();
    }
}