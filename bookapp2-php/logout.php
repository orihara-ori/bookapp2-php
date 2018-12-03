<?php
session_start();

session_destroy();
$message = 'ログアウトしました';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>bookapp</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
  <div><?= $message ?></div>
  <div><a href='login.php'>ログインページへ</a></div>
</body>
</html>