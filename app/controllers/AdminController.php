<?php
namespace app\controllers;

use app\service\AdminService;

use flight\Engine;

class AdminController {

    protected Engine $app;

    protected AdminService $adminService;
    public function __construct($app) {
        $this->app = $app;
        $this->adminService = new AdminService();
    }

    public function dashboard() {

        $exchanges = $this->adminService->getexchages();

        $this->app->render('admin/dashboard',[
            'exchanges' => $exchanges
        ]);
    }

}