<?php
namespace app\repositories;

use PDO;

class ObjectRepository {
    private $pdo;

    public function __construct(PDO $pdo) { 
        $this->pdo = $pdo; 
    }

    public function insertObject($name, $description, $category_id, $price, $image_url, $owner_id){
        $st = $this->pdo->prepare("
            INSERT INTO `object` (name, description, category_id, price, image_url, owner_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
    
        $st->execute([
            $name,
            $description,
            $category_id,
            $price,
            $image_url,
            $owner_id
        ]);
    
        return $this->pdo->lastInsertId();
    }

    public function getAllObject(){
        $st = $this->pdo->prepare("
            SELECT * 
            FROM `object`
            ORDER BY created_at DESC
        ");
        $st->execute();
    
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertImage($object_id, $url){
        $st = $this->pdo->prepare("
            INSERT INTO image (object_id, url)
            VALUES (?, ?)
        ");
        $st->execute([$object_id, $url]);
    }

    /**
     * Obtenir un objet par son ID
     */
    public function getObjectById($id) {
        $st = $this->pdo->prepare("SELECT * FROM object WHERE id = ?");
        $st->execute([(int)$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Compter le nombre total d'objets
     */
    public function getTotalObjects() {
        $st = $this->pdo->query("SELECT COUNT(*) as total FROM object");
        return (int)$st->fetchColumn();
    }

    /**
     * Obtenir les objets par catégorie
     */
    public function getObjectsByCategory($categoryId) {
        $st = $this->pdo->prepare("SELECT * FROM object WHERE category_id = ?");
        $st->execute([(int)$categoryId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Rechercher des objets
     */
    public function searchObjects($searchTerm) {
        $st = $this->pdo->prepare("
            SELECT * FROM object 
            WHERE name LIKE ? OR description LIKE ?
            ORDER BY created_at DESC
        ");
        $search = '%' . $searchTerm . '%';
        $st->execute([$search, $search]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mettre à jour un objet
     */
    public function updateObject($id, $name, $description, $category_id, $price) {
        $st = $this->pdo->prepare("
            UPDATE object 
            SET name = ?, description = ?, category_id = ?, price = ?
            WHERE id = ?
        ");
        return $st->execute([$name, $description, $category_id, $price, (int)$id]);
    }

    /**
     * Supprimer un objet
     */
    public function deleteObject($id) {
        $st = $this->pdo->prepare("DELETE FROM object WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    /**
     * Mettre à jour le statut d'un objet
     */
    public function updateObjectStatus($id, $status) {
        $st = $this->pdo->prepare("UPDATE object SET status = ? WHERE id = ?");
        return $st->execute([$status, (int)$id]);
    }

    /**
     * Changer le propriétaire d'un objet
     */
    public function updateObjectOwner($id, $newOwnerId) {
        $st = $this->pdo->prepare("UPDATE object SET owner_id = ? WHERE id = ?");
        return $st->execute([(int)$newOwnerId, (int)$id]);
    }

    /**
     * Obtenir les objets disponibles pour l'échange
     */
    public function getAvailableObjects() {
        $st = $this->pdo->prepare("
            SELECT * FROM object 
            WHERE status = 'available'
            ORDER BY created_at DESC
        ");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
