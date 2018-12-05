<?php
require_once(__DIR__ . "/../config.php");
require_once(__DIR__ . "/../Model/User.php");

session_start();


$response = ["status" => "no_login"];
if (empty($_SESSION['USERID'])) {
  echo json_encode($response);
  exit();
}

$response = ["status" => "ok"];
$user = new User();
$result = $user->findById($_SESSION['USERID']);

unset($result["password"]);
$response["body"] = $result;

header('Content-Type: application/json');
echo json_encode($response);


