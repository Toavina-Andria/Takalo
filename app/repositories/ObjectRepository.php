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
    

}

?>
