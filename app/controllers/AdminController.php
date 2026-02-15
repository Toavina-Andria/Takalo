<?php
namespace app\controllers;

use Flight;
use app\services\AdminService;
use flight\Engine;

class AdminController {

    protected Engine $app;

    protected AdminService $adminService;
    
    public function __construct($app = null) {
        $this->app = $app ?? Flight::app();
        $this->adminService = new AdminService($this->app);
    }

    public static function dashboard() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_connected'])) {
            Flight::redirect('/auth/login');
            return;
        }

        // Vérifier si c'est l'admin
        $user = $_SESSION['user_connected'];
        if ($user['email'] !== 'admin@gmail.com') {
            Flight::redirect('/objects');
            return;
        }

        // L'utilisateur est bien admin, afficher le dashboard
        $controller = new self();
        $exchanges = $controller->adminService->getAllExchangesWithDetails();

        Flight::render('admin/dashboard', [
            'title' => 'Dashboard',
            'pageTitle' => 'Admin Dashboard',
            'bodyClass' => '',
            'exchanges' => $exchanges
        ]);
    }

}