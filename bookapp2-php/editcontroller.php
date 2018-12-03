<?php
require_once("config.php");

$user = DB_USER;
$password = DB_PASSWORD;
$dbname = 'bookapp';
$host = 'localhost';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $user, $password);

$id = $_POST["id"];
$content = $_POST["content"];
$genre = $_POST["genre"];

$sql = "UPDATE notes SET content = :content, genre = :genre WHERE id = :id";
$stm = $pdo->prepare($sql);
$stm->bindValue(':id', $id, PDO::PARAM_STR);
$stm->bindValue(':content', $content, PDO::PARAM_STR);
$stm->bindValue(':genre', $genre, PDO::PARAM_STR);
$stm->execute();

if (isset($_FILES['imagefile'])) {
  $tmp_file = $_FILES['imagefile']['tmp_name'];
  if (is_uploaded_file($tmp_file)) {
    if (file_exists('images/' . $id . '/' )) {  // image/id/ の中にファイルが存在する場合
      $dir = opendir('images/' . $id);
      while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
        if ($image_name != "." && $image_name != "..") {  // .と..を除外
          unlink('images/' . $id . '/' . $image_name);  //  添付画像は一つまでという仕様なので古い画像は削除
        }
      }
      closedir($dir);
    }
    mkdir('./images/' . $id);
    move_uploaded_file($tmp_file, './images/' . $id . '/' . $_FILES['imagefile']['name']);
  }
}

header('Location: http://192.168.33.10:3000');
exit();
?>