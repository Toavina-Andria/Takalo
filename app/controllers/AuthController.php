<?php
namespace app\controllers;

use Flight;
use Throwable;
use app\repositories\UserRepository;
use app\services\Validator;
use app\services\UserService;

class AuthController
{

  private $viewRegister = 'auth/register';
  public function showRegister()
  {
    Flight::render($this->viewRegister, [
      'values' => ['username' => '', 'email' => ''],
      'errors' => ['username' => '', 'email' => '', 'password' => ''],
      'success' => false
    ]);
  }

  public function showAllUsers()
  {
    $repo = null;

    try {
      $pdo = Flight::db();
      $repo = new UserRepository($pdo);
    } catch (Throwable $dbError) {
      //
    }


    return $repo->getAllUser();
  }

  public function verificationUser($email)
  {
    $repo = null;
    try {
      $pdo = Flight::db();
      $repo = new UserRepository($pdo);
    } catch (Throwable $dbError) {
      //
    }

    if ($repo && $repo->emailExists($email)) {
      return true;
    }

    return false;
  }

  public function getUser($email)
  {
    $repo = null;
    try {
      $pdo = Flight::db();
      $repo = new UserRepository($pdo);
    } catch (Throwable $dbError) {
      //
    }

    if ($repo) {
      return $repo->getUserByEmail($email);
    }

    return null;
  }

  public function validateRegisterAjax()
  {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $req = Flight::request();

      $input = [
        'username' => $req->data->username,
        'email' => $req->data->email,
        'password' => $req->data->password,
      ];

      // Essayer de créer le repo pour vérifier si l'email existe déjà
      $repo = null;
      try {
        $pdo = Flight::db();
        $repo = new UserRepository($pdo);
      } catch (Throwable $dbError) {
        // Base de données non disponible, on continue sans vérification d'email
      }

      $res = Validator::validateRegister($input, $repo);

      Flight::json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);

    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation: ' . $e->getMessage()],
        'values' => []
      ]);
    }
  }

  public function postRegister()
  {
    $pdo = Flight::db();
    $repo = new UserRepository($pdo);
    $svc = new UserService($repo);

    $req = Flight::request();

    $input = [
      'username' => $req->data->username,
      'email' => $req->data->email,
      'password' => $req->data->password,
    ];

    $res = Validator::validateRegister($input, $repo);

    if ($res['ok']) {
      $svc->register($res['values'], (string) $input['password']);
      Flight::render($this->viewRegister, [
        'values' => ['username' => '', 'email' => ''],
        'errors' => ['username' => '', 'email' => '', 'password' => ''],
        'success' => true
      ]);
      return;
    }

    Flight::render($this->viewRegister, [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);

  }

  public static function showLogin()
  {
    Flight::render('auth/login', null);
  }

  public static function postLogin()
  {
    $app = Flight::app();
    $req = $app->request();
    $email = $req->data->email;

    $authController = new AuthController();

    if ($authController->verificationUser($email)) {
      $user = $authController->getUser($email);
      $_SESSION['user_connected'] = $user;
      $app->redirect('/listObjects');
    } else {
      $app->render('auth/login', [
        'error' => 'Email ou mot de passe incorrect.'
      ]);
    }
  }


}
