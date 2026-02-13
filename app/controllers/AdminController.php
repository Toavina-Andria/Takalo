<?php
namespace app\controllers;

use app\services\AdminService;

use flight\Engine;

class AdminController {

    protected Engine $app;

    protected AdminService $adminService;
    public function __construct($app) {
        $this->app = $app;
        $this->adminService = new AdminService($app);
    }

    public function dashboard() {

        $exchanges = $this->adminService->getAllExchangesWithDetails();

        $this->app->render('admin/dashboard',[
            'title' => 'Dashboard',
            'exchanges' => $exchanges
        ]);
    }

}