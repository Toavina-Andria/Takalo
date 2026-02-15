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
    
    public function findById(int $id): ?array {

        $sql = "
            SELECT 
                o.*,
                c.name AS category_name,
                u.username AS owner_username
            FROM object o
            LEFT JOIN category c ON o.category_id = c.id
            LEFT JOIN users u ON o.owner_id = u.id
            WHERE o.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $object = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$object) {
            return null;
        }

        // Récupération des images
        $imgStmt = $this->pdo->prepare("
            SELECT url FROM image WHERE object_id = :id
        ");
        $imgStmt->execute(['id' => $id]);

        $object['images'] = $imgStmt->fetchAll(PDO::FETCH_COLUMN);

        return $object;
    }
}

?>
