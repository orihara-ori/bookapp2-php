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
        <li><label>本文:<input type="text" name="content"></label></li>
        <li><label>ジャンル:<input type="text" name="genre"></label></li>
        <li><input type="submit" value="投稿する"></li>
      </ul>
    </form>
  </div>
</body>
</html>