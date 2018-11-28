<?php
$user = 'appuser';
$password = '12345';
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

header('Location: http://192.168.33.10:3000');
exit();
?>