<?php
namespace app\controllers;

use Flight;
use Throwable;
use app\repositories\ObjectRepository;
use app\services\ObjectService;

class ObjectDetailController {

    public function showObjectDetail($id)
    {
        $pdo = \Flight::db();
        $repo = new \app\repositories\ObjectRepository($pdo);
    
        $object = $repo->findById((int)$id);
    
        if (!$object) {
            \Flight::halt(404, "Objet non trouvé");
        }
    
        \Flight::view()->set('object', $object);
        \Flight::render('object/detailObject');
    }
    
}
