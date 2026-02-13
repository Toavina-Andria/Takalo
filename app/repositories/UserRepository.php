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

  /**
   * Compter le nombre total d'utilisateurs
   */
  public function getTotalUsers() {
    $st = $this->pdo->query("SELECT COUNT(*) as total FROM users");
    return (int)$st->fetchColumn();
  }

  /**
   * Obtenir les statistiques d'un utilisateur
   */
  public function getUserStats($userId) {
    $st = $this->pdo->prepare("
      SELECT 
        (SELECT COUNT(*) FROM object WHERE owner_id = ?) as total_objects,
        (SELECT COUNT(*) FROM exchange WHERE user1_id = ? OR user2_id = ?) as total_exchanges
    ");
    $st->execute([(int)$userId, (int)$userId, (int)$userId]);
    return $st->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Obtenir les objets d'un utilisateur
   */
  public function getUserObjects($userId) {
    $st = $this->pdo->prepare("SELECT * FROM object WHERE owner_id = ?");
    $st->execute([(int)$userId]);
    return $st->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Obtenir les échanges d'un utilisateur
   */
  public function getUserExchanges($userId) {
    $st = $this->pdo->prepare("SELECT * FROM exchange WHERE user1_id = ? OR user2_id = ?");
    $st->execute([(int)$userId, (int)$userId]);
    return $st->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Mettre à jour un utilisateur
   */
  public function updateUser($id, $username, $email) {
    $st = $this->pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    return $st->execute([(string)$username, (string)$email, (int)$id]);
  }

  /**
   * Supprimer un utilisateur
   */
  public function deleteUser($id) {
    $st = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
    return $st->execute([(int)$id]);
  }

  /**
   * Vérifier le mot de passe d'un utilisateur
   */
  public function verifyPassword($email, $password) {
    $user = $this->getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
      return $user;
    }
    return false;
  }
}

?>
