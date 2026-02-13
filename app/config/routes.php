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

    // traitement d' Inscription
    $router->get('/', [AuthController::class, 'showRegister']);
    $router->post('/register', [AuthController::class, 'postRegister']);
    $router->post('/api/validate/register', [AuthController::class, 'validateRegisterAjax']);

    // traitement de Login
    $router->group('/auth', function () use ($router) {
        $router->get('/login', [AuthController::class, 'showLogin']);
        $router->post('/login', [AuthController::class, 'postLogin']);
    });

    $router->get('/listObjects', [ObjectController::class, 'listObjects']);

    $router->group('/object', function () use ($router) {
        // Formulaire GET pour insérer un objet
        $router->get('/insertObject', [ObjectController::class, 'showInsertForm']);
        // POST pour créer un objet
        $router->post('/create', [ObjectController::class, 'postCreateObject']);
    });
    $router->get('/admin', [AdminController::class, 'dashboard']);


}, [SecurityHeadersMiddleware::class]);
