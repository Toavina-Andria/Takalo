<?php
namespace App\Models;
use Flight;
class ExchangeDAO
{

    public static function createExchange($object1Id, $object2Id, $user1Id, $user2Id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO exchange (object1_id, object2_id, user1_id, user2_id, status) VALUES (:object1_id, :object2_id, :user1_id, :user2_id, 'pending')");
        return $stmt->execute([
            'object1_id' => $object1Id,
            'object2_id' => $object2Id,
            'user1_id' => $user1Id,
            'user2_id' => $user2Id
        ]);
    }

    public static function getExchangesByUserId($userId)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchange WHERE user1_id = :user_id OR user2_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getExchangesByObjectId($objectId)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchange WHERE object1_id = :object_id OR object2_id = :object_id");
        $stmt->execute(['object_id' => $objectId]);
        return $stmt->fetchAll();
    }

    public function deleteExchange($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("DELETE FROM exchange WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function getAllExchanges()
    {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM exchange");
        return $stmt->fetchAll();
    }

    public static function getExchangeById($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchange WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function acceptExchange($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE exchange SET status = 'accepted' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function rejectExchange($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE exchange SET status = 'rejected' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function cancelExchange($id)
    {
        $db = Flight::db();
        $stmt = $db->prepare("UPDATE exchange SET status = 'cancelled' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function getExchangesByStatus($status)
    {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchange WHERE status = :status");
        $stmt->execute(['status' => $status]);
        return $stmt->fetchAll();
    }

    public static function getPendingExchanges()
    {
        return ExchangeDAO::getExchangesByStatus('pending');
    }

    public static function getAcceptedExchanges()
    {
        return ExchangeDAO::getExchangesByStatus('accepted');
    }

    public static function getRejectedExchanges()
    {
        return ExchangeDAO::getExchangesByStatus('rejected');
    }
}