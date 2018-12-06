<?php
require_once("config.php");
require_once("Model/User.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$id = $_SESSION['USERID'];
$user = new User();
$result = $user->findById($id)
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>bookapp</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
  <h1>ユーザー情報</h1>
  <div>
    <ul>
      <li>名前: <?= $result['name'] ?></li>
    </ul>
  </div>
  <div><a href='index.php'>ノート一覧</a></div>
</body>
</html>