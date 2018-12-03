<?php
require_once("config.php");
require_once("Model/User.php");

session_start();

if (isset($_SESSION['USERID'])) {
  header('Location: index.php');
  exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
  $user = DB_USER;
  $password = DB_PASSWORD;
  $dbname = 'bookapp';
  $host = 'localhost';
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  $pdo = new PDO($dsn, $user, $password);

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $user = new User();
  $user_id = $user->addUser($username, $hashed_password);

  $_SESSION['USERID'] = $user_id;
  header('Location: index.php');
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
  <h1>ユーザー登録</h1>
  <div>
    <form method="POST" action="">
      <li><label>名前: <input type="text" name="username"></label></li>
      <li><label>パスワード: <input type="text" name="password"></label></li>
      <li><input type="submit" value="ユーザー登録"></li>
    </form>
  </div>
</body>
</html>