<?php
namespace app\repositories;

use PDO;

class ExchangeRepository {
    private $pdo;

    public function __construct(PDO $pdo) { 
        $this->pdo = $pdo; 
    }

    /**
     * Créer un nouvel échange
     */
    public function createExchange($object1Id, $object2Id, $user1Id, $user2Id) {
        $st = $this->pdo->prepare("
            INSERT INTO exchange (object1_id, object2_id, user1_id, user2_id, status) 
            VALUES (?, ?, ?, ?, 'pending')
        ");
        $st->execute([(int)$object1Id, (int)$object2Id, (int)$user1Id, (int)$user2Id]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Obtenir tous les échanges
     */
    public function getAllExchanges() {
        $st = $this->pdo->query("SELECT * FROM exchange ORDER BY created_at DESC");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir un échange par son ID
     */
    public function getExchangeById($id) {
        $st = $this->pdo->prepare("SELECT * FROM exchange WHERE id = ?");
        $st->execute([(int)$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir les échanges d'un utilisateur
     */
    public function getExchangesByUserId($userId) {
        $st = $this->pdo->prepare("
            SELECT * FROM exchange 
            WHERE user1_id = ? OR user2_id = ?
            ORDER BY created_at DESC
        ");
        $st->execute([(int)$userId, (int)$userId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir les échanges pour un objet
     */
    public function getExchangesByObjectId($objectId) {
        $st = $this->pdo->prepare("
            SELECT * FROM exchange 
            WHERE object1_id = ? OR object2_id = ?
            ORDER BY created_at DESC
        ");
        $st->execute([(int)$objectId, (int)$objectId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir les échanges par statut
     */
    public function getExchangesByStatus($status) {
        $st = $this->pdo->prepare("
            SELECT * FROM exchange 
            WHERE status = ?
            ORDER BY created_at DESC
        ");
        $st->execute([$status]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtenir les échanges en attente
     */
    public function getPendingExchanges() {
        return $this->getExchangesByStatus('pending');
    }

    /**
     * Obtenir les échanges acceptés
     */
    public function getAcceptedExchanges() {
        return $this->getExchangesByStatus('accepted');
    }

    /**
     * Obtenir les échanges rejetés
     */
    public function getRejectedExchanges() {
        return $this->getExchangesByStatus('rejected');
    }

    /**
     * Accepter un échange
     */
    public function acceptExchange($id) {
        $st = $this->pdo->prepare("UPDATE exchange SET status = 'accepted' WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    /**
     * Rejeter un échange
     */
    public function rejectExchange($id) {
        $st = $this->pdo->prepare("UPDATE exchange SET status = 'rejected' WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    /**
     * Annuler un échange
     */
    public function cancelExchange($id) {
        $st = $this->pdo->prepare("UPDATE exchange SET status = 'cancelled' WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    /**
     * Supprimer un échange
     */
    public function deleteExchange($id) {
        $st = $this->pdo->prepare("DELETE FROM exchange WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    /**
     * Compter le nombre total d'échanges
     */
    public function getTotalExchanges() {
        $st = $this->pdo->query("SELECT COUNT(*) as total FROM exchange");
        return (int)$st->fetchColumn();
    }

    /**
     * Compter les échanges par statut
     */
    public function countExchangesByStatus($status) {
        $st = $this->pdo->prepare("SELECT COUNT(*) as total FROM exchange WHERE status = ?");
        $st->execute([$status]);
        return (int)$st->fetchColumn();
    }

    /**
     * Obtenir les statistiques des échanges
     */
    public function getExchangeStats() {
        $st = $this->pdo->query("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = 'accepted' THEN 1 ELSE 0 END) as accepted,
                SUM(CASE WHEN status = 'rejected' THEN 1 ELSE 0 END) as rejected,
                SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled
            FROM exchange
        ");
        return $st->fetch(PDO::FETCH_ASSOC);
    }
}

?>
