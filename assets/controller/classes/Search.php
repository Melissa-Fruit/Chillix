<?php
// SEARCH ENGINE=============================

if (isset($_POST["search_submit"])) {

    $searchQuery = $_POST["search"];
    $searchQuery = FormSanitizer::sanitizeFormString($searchQuery);
    $searchQuery = "%" . $searchQuery . "%";
  
    if ($searchQuery == "") {
      return;
    } else {
      $stmt = $con->prepare("SELECT * FROM movie WHERE title LIKE :searchQuery");
      $stmt->bindParam(":searchQuery", $searchQuery);
      $stmt->execute();
      if ($stmt->rowCount() == 0) {
        $stmt = $con->query("SELECT * FROM movie WHERE movie_id = $randNum");
        $firstResult = $stmt->fetch(PDO::FETCH_ASSOC);
        // header("Location: main.php?movie=" . $firstResult["title"]);
      } else if ($stmt->rowCount() == 1) {
        $firstResult = $stmt->fetch(PDO::FETCH_ASSOC);
        // header("Location: main.php?movie=" . $firstResult["title"]);
      } else if ($stmt->rowCount() > 1) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $firstResult = $results[0];
        // header("Location: main.php?movie=" . $firstResult["title"]);
      }
    }
  }