<?php
require_once("config.php");
require_once("Model/Note.php");

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
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<div id="name_display">no login</div>
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
      $user_id = $_SESSION['USERID'];
      $note = new Note();
      $result = $note->getAllCurrentUsersNotes($user_id);
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
  <div><a href='profile.php'>ユーザー情報</a></div>
  <div><a href='logout.php'>ログアウト</a></div>

<script>
  $.ajax({
    type: "GET",
    url: "/api/nickname.php",
    success: function(msg){
      if (msg.status == "ok") {
        $('#name_display').text(msg.body.name+"さんようこそ！");
      }
    }
  });
</script>
</body>
</html>