<?php
require_once("config.php");
require_once("Model/Note.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$note_id = $_POST["id"];
$user_id = $_SESSION['USERID'];
$content = $_POST["content"];
$genre = $_POST["genre"];

$note = new Note();
if($id = $note->updateNote($content, $genre, $note_id, $user_id)) {  //もしノートが無事に更新されたならば
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
}

header('Location: http://192.168.33.10:3000');
exit();
?>