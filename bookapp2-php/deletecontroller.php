<?php
require_once("config.php");

$user = DB_USER;
$password = DB_PASSWORD;
$dbname = 'bookapp';
$host = 'localhost';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $user, $password);

$id = $_POST["id"];

$sql = "DELETE FROM notes WHERE id = :id";
$stm = $pdo->prepare($sql);
$stm->bindValue(':id', $id, PDO::PARAM_STR);
$stm->execute();

header('Location: http://192.168.33.10:3000');
exit();
?>