<?php
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/Model/Note.php");

$id = $_POST["id"];

$note = new Note();
$note->destroyNoteById($id);

if (file_exists('images/' . $id . '/' )) {  // image/id/ の中にファイルが存在する場合
  $dir = opendir('images/' . $id);
  while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
    if ($image_name != "." && $image_name != "..") {  // .と..を除外
      unlink('images/' . $id . '/' . $image_name);
    }
  }
  closedir($dir);
}

header('Location: http://192.168.33.10:3000');
exit();
?>