<?php 
namespace app\services;

use app\repositories\ObjectRepository;
use PDO;

class ObjectService {
    private  $repo;

    public function __construct(PDO $pdo) {
        $this->repo = new ObjectRepository($pdo);
    }

    public function createObject(array $data): void
    {
        if (empty($data['name']) || $data['category_id'] <= 0) {
            throw new \Exception("Données invalides.");
        }

        if ($data['price'] < 0) {
            throw new \Exception("Le prix ne peut pas être négatif.");
        }

        $imageUrl = null;
        if ($data['image'] && $data['image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($data['image']['type'], $allowedTypes)) {
                throw new \Exception("Type de fichier non autorisé.");
            }

            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileExtension = pathinfo($data['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                throw new \Exception("Erreur lors de l'upload de l'image.");
            }

            $imageUrl = '/uploads/' . $fileName;
        }

        // 3️⃣ Appel au repository pour insérer l'objet
        $this->repo->insertObject(
            $data['name'],
            $data['description'] ?? null,
            $data['category_id'],
            $data['price'],
            $imageUrl,
            $data['owner_id']
        );
    }
}
