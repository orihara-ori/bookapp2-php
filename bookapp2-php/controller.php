<?php
require_once("config.php");

$user = DB_USER;
$password = DB_PASSWORD;
$dbname = 'bookapp';
$host = 'localhost';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $user, $password);

$content = $_POST["content"];
$genre = $_POST["genre"];

$sql = "INSERT INTO notes (content, genre) VALUES (:content, :genre)";
$stm = $pdo->prepare($sql);
$stm->bindValue(':content', $content, PDO::PARAM_STR);
$stm->bindValue(':genre', $genre, PDO::PARAM_STR);
$stm->execute();

if (isset($_FILES['imagefile'])) {
  $tmp_file = $_FILES['imagefile']['tmp_name'];
  if (is_uploaded_file($tmp_file)) {
    $id = $pdo->lastInsertId();
    mkdir('./images/' . $id);
    move_uploaded_file($tmp_file, './images/' . $id . '/' . $_FILES['imagefile']['name']);
  }
}

header('Location: http://192.168.33.10:3000');
exit();
?>