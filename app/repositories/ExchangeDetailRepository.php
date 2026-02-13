<?php

namespace app\repositories;

use Flight;

class ExchangeDetailRepository {

    public function getAllExchangesWithDetails() {
        $db = Flight::db();
        $stmt = $db->query("SELECT * FROM exchanges_with_details");
        return $stmt->fetchAll();
    }

    public function getExchangesByUserId($userId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchanges_with_details WHERE user1_id = :user_id OR user2_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function getExchangeById($exchangeId) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM exchanges_with_details WHERE exchange_id = :exchange_id");
        $stmt->execute(['exchange_id' => $exchangeId]);
        return $stmt->fetch();
    }
}
