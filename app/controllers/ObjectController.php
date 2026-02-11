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
    public static function postCreateObject() {
        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {
            $filename = time() . '_' . $_FILES['image']['name'];
            $target = 'uploads/' . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $imagePath = '/' . $target;
        }

        $controller = new ObjectController();

        $controller->createObject(
            $_POST['name'],
            $_POST['description'],
            $_POST['category_id'],
            $_POST['price'],
            $imagePath,
            $_SESSION['user_connected']['id']
        );

        Flight::app()->redirect('/listObjects');
    }
}
