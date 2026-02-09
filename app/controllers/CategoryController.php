<?php
namespace app\controllers;

use Flight;
use Throwable;
use app\repositories\CategoryRepository;

class CategoryController {

    /**
     * Récupère toutes les catégories et les passe à la vue insertObject
     */
    public function showInsertObjectForm() {
        $categories = [];

        try {
            $pdo = Flight::db();
            $repo = new CategoryRepository($pdo);
            $categories = $repo->getAllCategories();
        } catch (Throwable $e) {
            // Si erreur DB, laisse categories vide
        }

        Flight::view()->set('categories', $categories);
        Flight::render('object/insertObject');
    }
}
