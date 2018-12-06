<?php
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/Model/Note.php");

$id = $_POST["id"];
$content = $_POST["content"];
$genre = $_POST["genre"];

$note = new Note();
$note->updateNote($content, $genre, $id);

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