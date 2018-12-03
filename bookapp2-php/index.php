<?php
require_once("config.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$user = DB_USER;
$password = DB_PASSWORD;
$dbname = 'bookapp';
$host = 'localhost';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
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
    <form method="POST" action="controller.php" enctype='multipart/form-data'>
      <ul>
        <li><label>本文: <input type="text" name="content"></label></li>
        <li><label>ジャンル: <input type="text" name="genre"></label></li>
        <li><label>画像添付: <input type='file' name='imagefile'></label></li>
        <li><input type="submit" value="投稿する"></li>
      </ul>
    </form>
  </div>

  <div>
    <!-- note一覧を取りにDBへ接続 -->
    <?php
      $pdo = new PDO($dsn, $user, $password);
      $sql = "SELECT * FROM notes";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <ul>
      <?php
        foreach($result as $value){
          echo "<li>本文:", $value['content'], "<br>ジャンル:",$value['genre'], "</li>";
          if (file_exists('images/' . $value['id'] . '/' )) {  // image/id/ の中にファイルが存在する場合
            $dir = opendir('images/' . $value['id']);
            while ($image_name = readdir($dir)) {  // ディレクトリを順番に読み込み
              if ($image_name != "." && $image_name != "..") {  // .と..を除外
                echo '<img src="images/' . $value['id'] . '/' . $image_name .'" width="256" height="256">';
              }
            }
            closedir($dir);
          }
          ?>
          <!-- 編集ボタン -->
          <form method="GET" action="edit.php">
            <label><input type="hidden" name="id" value="<?= $value['id'] ?>"></label>
            <label><input type="hidden" name="content" value="<?= $value['content'] ?>"></label>
            <label><input type="hidden" name="genre" value="<?= $value['genre'] ?>"></label>
            <input type="submit" value="編集">
          </form>

          <!-- 削除ボタン -->
          <form method="POST" action="deletecontroller.php">
            <label><input type="hidden" name="id" value="<?= $value['id'] ?>"></label>
            <input type="submit" value="削除">
          </form>
          <?php
        }
      ?>
    </ul>
  </div>
  <div><a href='logout.php'>ログアウト</a></div>
</body>
</html>