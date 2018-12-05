<?php
require_once("config.php");

class Note {
  private $db;
  function __construct() {
    $user = DB_USER;
    $password = DB_PASSWORD;
    $dbname = 'bookapp';
    $host = 'localhost';
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
    $this->db = new PDO($dsn, $user, $password);
  }

  public function getAllNotes() {
    $sql = "SELECT * FROM notes";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

   public function findNoteById($id) {
    $sql = "SELECT * FROM notes WHERE id = :id";
    $stm = $this->db->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function addNote($content, $genre) {
    $sql = "INSERT INTO notes (content, genre) VALUES (:content, :genre)";
    $stm = $this->db->prepare($sql);
    $stm->bindValue(':content', $content, PDO::PARAM_STR);
    $stm->bindValue(':genre', $genre, PDO::PARAM_STR);
    $stm->execute();
    return $this->db->lastInsertId();
  }

  public function updateNote($content, $genre, $id) {
    $sql = "UPDATE notes SET content = :content, genre = :genre WHERE id = :id";
    $stm = $this->db->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_STR);
    $stm->bindValue(':content', $content, PDO::PARAM_STR);
    $stm->bindValue(':genre', $genre, PDO::PARAM_STR);
    $stm->execute();
    return $this->db->lastInsertId();
  }

  public function destroyNoteById($id) {
    $sql = "DELETE FROM notes WHERE id = :id";
    $stm = $this->db->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_STR);
    $stm->execute();
    return $this->db->lastInsertId();
  }
}
?>