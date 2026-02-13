<?php
namespace app\services;

use app\repositories\UserRepository;

class Validator
{

  public static function normalizeTelephone($tel)
  {
    return preg_replace('/\s+/', '', trim((string) $tel));
  }

  public static function validateRegister(array $input, UserRepository $repo)
  {
    $errors = [
      'username' => '',
      'email' => '',
      'password' => ''
    ];

    $values = [
      'username' => trim((string) ($input['username'] ?? '')),
      'email' => trim((string) ($input['email'] ?? '')),
    ];

    $password = (string) ($input['password'] ?? '');

    if (mb_strlen($values['username']) < 2) {
      $errors['username'] = "Le nom doit contenir au moins 2 caractères.";
    }

    if ($values['email'] === '') {
      $errors['email'] = "L'email est obligatoire.";

    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "L'email n'est pas valide (ex: nom@domaine.com).";
    }

    if (strlen($password) < 8) {
      $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if ($repo && $errors['email'] === '' && $repo->emailExists($values['email'])) {
      $errors['email'] = "Cet email est déjà utilisé.";
    }

    $ok = true;
    foreach ($errors as $m) {
      if ($m !== '') {
        $ok = false;
        break;
      }
    }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

}

