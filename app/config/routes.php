<?php

use app\controllers\ApiExampleController;
use app\controllers\AuthController;
use app\controllers\ObjectController;
use app\controllers\CategoryController;
use app\middlewares\SecurityHeadersMiddleware;

use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

$router->group('', function(Router $router) use ($app) {

    // traitement d' Inscription
    $authController = new AuthController();

    $router->get('/', [$authController, 'showRegister']);
    $router->post('/register', [$authController, 'postRegister']);
    $router->post('/api/validate/register', [$authController, 'validateRegisterAjax']);

    // traitement de Login
    $router->group('/auth', function() use ($router, $app) {
        $router->get('/login', function() use ($app) {
            $app->render('auth/login', null);
        });

        $router->post('/login', function() use ($app) {
            $req = $app->request();
            $email = $req->data->email;
        
            $authController = new AuthController();

            if($authController->verificationUser($email)) {
                $user = $authController->getUser($email);
                $_SESSION['user_connected'] = $user;
                $app->redirect('/listObjects');
            } else {
                $app->render('auth/login', [
                    'error' => 'Email ou mot de passe incorrect.'
                ]);
            }
        });
    });

    $router->get('/listObjects', function() use ($app) {

        $objectController = new ObjectController();
        $list_object = $objectController->showAllObject();

        Flight::view()->set('list_object',$list_object);

        $app->render('object/listObject');
    });
    
    // Formulaire GET pour insérer un objet
    $router->get('/object/insertObject', function() use ($app) {
        $categoryController = new CategoryController();
        $categoryController->showInsertObjectForm();
    });

    // POST pour créer un objet
    $router->post('/object/create', function() use ($app) {

        $imagePath = null;

        if (!empty($_FILES['image']['name'])) {
            $filename = time() . '_' . $_FILES['image']['name'];
            $target = 'uploads/' . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $imagePath = '/' . $target;
        }

        $controller = new \app\controllers\ObjectController();

        $controller->createObject(
            $_POST['name'],
            $_POST['description'],
            $_POST['category_id'],
            $_POST['price'],
            $imagePath,
            $_SESSION['user_connected']['id']
        );

        $app->redirect('/listObjects');
    });

}, [ SecurityHeadersMiddleware::class ]);
