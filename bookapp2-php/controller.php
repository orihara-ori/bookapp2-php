<?php
require_once("config.php");
require_once("Model/Note.php");

session_start();

if (is_null($_SESSION['USERID'])) {
  header('Location: login.php');
  exit();
}

$content = $_POST["content"];
$genre = $_POST["genre"];
$user_id = $_SESSION['USERID'];
$parent_id = null;

$note = new Note();
$note_id = $note->addNote($content, $genre, $user_id, $parent_id);

if (isset($_FILES['imagefile'])) {
  $tmp_file = $_FILES['imagefile']['tmp_name'];
  if (is_uploaded_file($tmp_file)) {
    mkdir('./images/' . $note_id);
    move_uploaded_file($tmp_file, './images/' . $note_id . '/' . $_FILES['imagefile']['name']);
  }
}

header('Location: http://192.168.33.10:3000');
exit();
?>