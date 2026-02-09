<?php

use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\AdminController;
/**
 * @var Router $router
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {

	$router->get('/', function() use ($app) {
		$app->render('welcome', [ 'message' => 'You are gonna do great things!' ]);
	});

	$router->get('/admin', [AdminController::class, 'dashboard']);

	
}, [ SecurityHeadersMiddleware::class ]);