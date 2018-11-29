<?php
require_once("config.php");

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
    <form method="POST" action="controller.php">
      <ul>
        <li><label>本文: <input type="text" name="content"></label></li>
        <li><label>ジャンル: <input type="text" name="genre"></label></li>
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

</body>
</html>