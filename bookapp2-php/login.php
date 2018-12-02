<?php
require_once("config.php");

session_start();

if (isset($_SESSION['USERID'])) {
  header('Location: index.php');
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

  $sql = "SELECT * FROM users WHERE name = :username";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':username', $username, PDO::PARAM_STR);
  $stm->execute();
  $result = $stm->fetch(PDO::FETCH_ASSOC);

  if (password_verify($password, $result['password'])) {
    $_SESSION['USERID'] = $username;
    header('Location: index.php');
    exit();
  }
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
  <h1>ログイン</h1>
  <div>
    <form method="POST" action="">
      <li><label>名前: <input type="text" name="username"></label></li>
      <li><label>パスワード: <input type="text" name="password"></label></li>
      <li><input type="submit" value="ログインする"></li>
    </form>
  </div>
</body>
</html>