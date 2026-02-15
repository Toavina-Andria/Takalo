<?php

use app\controllers\AuthController;
use app\controllers\ObjectController;
use app\middlewares\SecurityHeadersMiddleware;

use flight\Engine;
use flight\net\Router;
use app\controllers\AdminController;
/**
 * @var Router $router
 * @var Engine $app
 */

$router->group('', function (Router $router) {

    // Redirect root to login page (login-first approach)
    $router->get('/', function() {
        Flight::redirect('/auth/login');
    });

    // traitement de Login (seule page publique)
    $router->group('/auth', function () use ($router) {
        $router->get('/login', [AuthController::class, 'showLogin']);
        $router->post('/login', [AuthController::class, 'postLogin']);
        $router->get('/logout', [AuthController::class, 'logout']);
    });

    // Protected routes - require authentication
    $router->get('/objects', [ObjectController::class, 'listObjects']);

    $router->group('/object', function () use ($router) {
        // Formulaire GET pour insérer un objet
        $router->get('/insertObject', [ObjectController::class, 'showInsertForm']);
        // POST pour créer un objet
        $router->post('/create', [ObjectController::class, 'postCreateObject']);
        $router->get('/detail/@id', [ObjectController::class, 'showDetail']);
    });
    
    // Admin dashboard - restricted to admin only
    $router->get('/admin', [AdminController::class, 'dashboard']);


}, [SecurityHeadersMiddleware::class]);
