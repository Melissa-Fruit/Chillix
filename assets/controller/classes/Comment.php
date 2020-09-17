<?php
// COMMENTS====================

$id = $firstResult['movie_id'];
$comments = $con->query("SELECT * FROM comments  WHERE id_movie =" . $id . " ORDER BY date_time DESC");

if (isset($_SESSION["loggedin"])) {
  $comment_username = $_SESSION["username"];
  $un_request = "SELECT * FROM users WHERE username = '$comment_username'";
  $un_stmt = $con->query($un_request);
  $un_result = $un_stmt->fetch(PDO::FETCH_ASSOC);

  if (isset($_POST['comment_submit'])) {
    if (!empty($_POST['comment_content'])) {
      $comment_content = htmlspecialchars($_POST['comment_content']);
      $id_movie = $_POST['movie_id'];
      $insert = $con->prepare('INSERT INTO comments (username, content, id_movie, id_user, date_time) VALUES (?, ?, ?, ?, NOW())');
      $insert->execute(array($comment_username, $comment_content, $id_movie, $un_result["id"]));
      header('Location: ' . $_SERVER['REQUEST_URI']);
    }
  }
}