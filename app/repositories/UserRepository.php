<?php
namespace app\repositories;

use PDO;

class UserRepository {
  private $pdo;

  public function __construct(PDO $pdo) { 
    $this->pdo = $pdo; 
  }

  public function emailExists($email) {
    $st = $this->pdo->prepare("SELECT 1 FROM users WHERE email=? LIMIT 1");
    $st->execute([(string)$email]);

    return (bool)$st->fetchColumn();
  }

  public function create($username, $email, $password) {
    $st = $this->pdo->prepare("
      INSERT INTO users(username, email, password)
      VALUES(?,?,?)
    ");
    $st->execute([(string)$username, (string)$email, (string)$password]);

    return $this->pdo->lastInsertId();
  }

  public function getUserByEmail($email) {
    $st = $this->pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $st->execute([(string)$email]);

    return $st->fetch();
  }

  public function getUserById($id) {
    $st = $this->pdo->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    $st->execute([(int)$id]);

    return $st->fetch();
  }

  public function getAllUser(){
    $st = $this->pdo->query("SELECT * FROM users");
    return $st->fetchAll();

  }
}

?>
