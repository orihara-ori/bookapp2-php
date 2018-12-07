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
    <form method="POST" action="create_new_note.php" enctype='multipart/form-data'>
      <ul>
        <li><label>本文: <input type="text" name="content"></label></li>
        <li><label>ジャンル: <input type="text" name="genre"></label></li>
        <li><label>画像添付: <input type='file' name='imagefile'></label></li>
        <li><input type="submit" value="投稿する"></li>
      </ul>
    </form>
  </div>

  <div>
    <ul>
      {foreach from=$notes item=note}
        <li>本文: {$note.content}<br>ジャンル: {$note.genre}</li>
        {$id = $note.id}
        {if isset($images.$id)}
          <img src="../images/{$note.id}/{$images.$id}" width="256" height="256">
        {/if}

        <form method="GET" action="edit_note.php">
          <label><input type="hidden" name="id" value="{$note.id}"></label>
          <label><input type="hidden" name="content" value="{$note.id}"></label>
          <label><input type="hidden" name="genre" value="{$note.id}"></label>
          <input type="submit" value="編集">
        </form>

        <form method="POST" action="delete_note.php">
          <label><input type="hidden" name="id" value="{$note.id}"></label>
          <input type="submit" value="削除">
        </form>

      {/foreach}      
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