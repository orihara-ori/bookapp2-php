<?php
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/Model/Note.php");

$content = $_POST["content"];
$genre = $_POST["genre"];

$note = new Note();
$id = $note->addNote($content, $genre);

if (isset($_FILES['imagefile'])) {
  $tmp_file = $_FILES['imagefile']['tmp_name'];
  if (is_uploaded_file($tmp_file)) {
    mkdir('./images/' . $id);
    move_uploaded_file($tmp_file, './images/' . $id . '/' . $_FILES['imagefile']['name']);
  }
}

header('Location: http://192.168.33.10:3000');
exit();
?>