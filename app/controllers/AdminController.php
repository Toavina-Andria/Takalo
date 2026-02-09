<?php
namespace app\controllers;

use flight\Engine;

class AdminController {

    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function dashboard() {
        $this->app->render('admin/dashboard');
    }
}