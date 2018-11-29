<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>bookapp</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
  <div>
    <form method="POST" action="editcontroller.php">
      <ul>
        <label><input type='hidden' name='id' value=<?= $_GET['id'] ?>></label>
        <li><label>本文: <input type="text" name="content" value=<?= $_GET['content'] ?>></label></li>
        <li><label>ジャンル: <input type="text" name="genre" value=<?= $_GET['genre'] ?>></label></li>
        <li><input type="submit" value="編集する"></li>
      </ul>
    </form>
  </div>
</body>
</html>