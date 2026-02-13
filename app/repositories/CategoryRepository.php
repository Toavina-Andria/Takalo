<?php
namespace app\repositories;

use PDO;

class CategoryRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Récupérer toutes les catégories
     */
    public function getAllCategories() {
        $st = $this->pdo->prepare("
            SELECT id, name
            FROM category
            ORDER BY name ASC
        ");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}
