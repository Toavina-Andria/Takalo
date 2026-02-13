<?php

// ===== CONFIG SESSION (IMPORTANT SUR macOS + XAMPP) =====
$sessionPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'sessions';

if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}

ini_set('session.save_path', $sessionPath);
session_start();
// =======================================================

$ds = DIRECTORY_SEPARATOR;
require(__DIR__ . $ds . '..' . $ds . '..' . $ds . 'vendor' . $ds . 'autoload.php');

if (!file_exists(__DIR__ . $ds . 'config.php')) {
    Flight::halt(500, 'Config file not found. Please create a config.php file in the app/config directory to get started.');
}

$app = Flight::app();

$config = require('config.php');

require('services.php');

$router = $app->router();

require('routes.php');

$app->start();
