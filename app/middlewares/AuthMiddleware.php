<?php

namespace app\middlewares;

use Flight;

class AuthMiddleware
{
    /**
     * Vérifie si l'utilisateur est authentifié
     * Redirige vers /auth/login si non connecté
     */
    public function before()
    {
        if (!isset($_SESSION['user_connected'])) {
            Flight::redirect('/auth/login');
            return false;
        }
        return true;
    }

    /**
     * Vérifie si l'utilisateur est admin
     * Redirige vers /objects si non admin
     */
    public function requireAdmin()
    {
        if (!isset($_SESSION['user_connected'])) {
            Flight::redirect('/auth/login');
            return false;
        }

        $user = $_SESSION['user_connected'];
        
        // Vérifier si c'est l'admin
        if ($user['email'] !== 'admin@gmail.com') {
            Flight::redirect('/objects');
            return false;
        }

        return true;
    }
}
