<?php
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../Model/Note.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['USERID'];
$note = new Note();
$result = $note->getAllCurrentUsersNotes($user_id);

$images = array();
foreach($result as $value){
  if (file_exists('../images/' . $value['id'] . '/' )) {  // image/id/ の中にファイルが存在する場合
    $dir = opendir('../images/' . $value['id']);
    while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
      if ($image_name != "." && $image_name != "..") {  // .と..を除外
        $images += array($value['id'] => $image_name);  //note_idをキーとして画像名を配列に追加
      }
    }
    closedir($dir);
  }
}

$smarty = new Smarty_Bookapp();
$smarty->caching = 0;
$smarty->assign('notes', $result);
$smarty->assign('images', $images);
$smarty->display('index.tpl');

?>
