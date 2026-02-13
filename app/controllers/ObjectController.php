<?php
namespace app\controllers;

use Flight;
use Throwable;
use app\repositories\ObjectRepository;

class ObjectController {

    /**
     * Afficher tous les objets
     */
    public function showAllObject() {
        $repo = null;
        $list_object = null;

        try {
            $pdo = Flight::db();
            $repo = new ObjectRepository($pdo);
        } catch (Throwable $dbError) {
            // Erreur base de données
        }

        if ($repo) {
            $list_object = $repo->getAllObject();
        }

        return $list_object;
    }

    /**
     * Créer un objet (image simple)
     */
    public function createObject($name, $description, $category_id, $price, $image_url, $owner_id) {
        $repo = null;

        try {
            $pdo = Flight::db();
            $repo = new ObjectRepository($pdo);
        } catch (Throwable $dbError) {
            return false;
        }

        if (!$repo) {
            return false;
        }

        return $repo->insertObject(
            $name,
            $description,
            $category_id,
            $price,
            $image_url,
            $owner_id
        );
    }

    /**
     * Créer un objet avec plusieurs images
     */
    public function createObjectWithImages($name, $description, $category_id, $price, $owner_id, array $images = []) {
        $repo = null;

        try {
            $pdo = Flight::db();
            $repo = new ObjectRepository($pdo);
        } catch (Throwable $dbError) {
            return false;
        }

        if (!$repo) {
            return false;
        }

        // Insertion de l'objet
        $object_id = $repo->insertObject(
            $name,
            $description,
            $category_id,
            $price,
            null,
            $owner_id
        );

        // Insertion des images
        foreach ($images as $url) {
            $repo->insertImage($object_id, $url);
        }

        return $object_id;
    }

    /**
     * Afficher la liste des objets (route)
     */
    public static function listObjects() {
        $objectController = new ObjectController();
        $list_object = $objectController->showAllObject();

        Flight::view()->set('list_object', $list_object);
        Flight::render('object/listObject');
    }

    /**
     * Afficher le formulaire d'insertion
     */
    public static function showInsertForm() {
        $categoryController = new \app\controllers\CategoryController();
        $categoryController->showInsertObjectForm();
    }

    /**
     * Traiter la création d'un objet
     */
    public function postCreateObject()
    {
        try {

            if (!isset($_SESSION['user'])) {
                $_SESSION['user'] = [
                    'id' => 1,
                    'username' => 'testuser',
                    'email' => 'test@test.com'
                ];
            }

            $pdo = \Flight::db();
            $repo = new \app\repositories\ObjectRepository($pdo);

            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $category_id = (int) ($_POST['category_id'] ?? 0);
            $price = (float) ($_POST['price'] ?? 0);
            $owner_id = $_SESSION['user']['id'];

            if ($name === '' || $category_id <= 0) {
                die("Données invalides.");
            }

            if ($price < 0) {
                die("Le prix ne peut pas être négatif.");
            }

            $imageUrl = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    die("Type de fichier non autorisé.");
                }

                $uploadDir = __DIR__ . '/../../public/uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fileName = uniqid() . '.' . $fileExtension;

                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imageUrl = '/uploads/' . $fileName;
                }
            }

            $repo->insertObject(
                $name,
                $description,
                $category_id,
                $price,
                $imageUrl,
                $owner_id
            );

            Flight::redirect('/listObjects');

        } catch (\Throwable $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
}
