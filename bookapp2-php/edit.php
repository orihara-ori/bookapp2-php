<?php
session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>bookapp</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
  <div>
    <form method="POST" action="editcontroller.php" enctype='multipart/form-data'>
      <ul>
        <label><input type="hidden" name="id" value="<?= $_GET['id'] ?>"></label>
        <li><label>本文: <input type="text" name="content" value="<?= $_GET['content'] ?>"></label></li>
        <li><label>ジャンル: <input type="text" name="genre" value="<?= $_GET['genre'] ?>"></label></li>
        <?php
        if (file_exists('images/' . $_GET['id'] . '/' )) {  // image/id/ の中にファイルが存在する場合
          $dir = opendir('images/' . $_GET['id']);
          while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
            if ($image_name != "." && $image_name != "..") {  // .と..を除外
              echo '<li><label>画像: <img src="images/' . $_GET['id'] . '/' . $image_name .'" width="256" height="256"></label></li>';
            }
          }
          closedir($dir);
        }
        ?>
        <li><label>画像添付: <input type='file' name='imagefile'></label></li>
        <li><input type="submit" value="編集する"></li>
      </ul>
    </form>
  </div>
</body>
</html>