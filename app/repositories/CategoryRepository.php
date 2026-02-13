<?php
namespace app\repositories;

use PDO;

class CategoryRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCategories() {
        $st = $this->pdo->prepare("
            SELECT id, name
            FROM category
            ORDER BY name ASC
        ");
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $st = $this->pdo->prepare("SELECT * FROM category WHERE id = ?");
        $st->execute([(int)$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function getTotalCategories() {
        $st = $this->pdo->query("SELECT COUNT(*) as total FROM category");
        return (int)$st->fetchColumn();
    }

    public function createCategory($name) {
        $st = $this->pdo->prepare("INSERT INTO category (name) VALUES (?)");
        $st->execute([$name]);
        return $this->pdo->lastInsertId();
    }

    public function updateCategory($id, $name) {
        $st = $this->pdo->prepare("UPDATE category SET name = ? WHERE id = ?");
        return $st->execute([$name, (int)$id]);
    }

    public function deleteCategory($id) {
        $st = $this->pdo->prepare("DELETE FROM category WHERE id = ?");
        return $st->execute([(int)$id]);
    }

    public function getCategoryObjects($categoryId) {
        $st = $this->pdo->prepare("
            SELECT * FROM object 
            WHERE category_id = ?
            ORDER BY created_at DESC
        ");
        $st->execute([(int)$categoryId]);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function countObjectsByCategory($categoryId) {
        $st = $this->pdo->prepare("SELECT COUNT(*) as total FROM object WHERE category_id = ?");
        $st->execute([(int)$categoryId]);
        return (int)$st->fetchColumn();
    }
}

