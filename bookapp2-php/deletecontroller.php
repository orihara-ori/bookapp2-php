<?php
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/Model/Note.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$note_id = $_POST["id"];
$user_id = $_SESSION['USERID'];

$note = new Note();
if($id = $note->destroyNoteById($note_id, $user_id)) {  //削除が成功した場合
  if (file_exists('images/' . $id . '/' )) {  // image/id/ の中にファイルが存在する場合
    $dir = opendir('images/' . $id);
    while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
      if ($image_name != "." && $image_name != "..") {  // .と..を除外
        unlink('images/' . $id . '/' . $image_name);
      }
    }
    closedir($dir);
  }
}

header('Location: http://192.168.33.10:3000');
exit();
?>