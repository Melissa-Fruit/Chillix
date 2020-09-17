<?php

ob_start();
session_start();

require_once("../assets/model/includes/config-local.php");
require_once("../assets/controller/classes/Funk.php");
require_once("../assets/controller/classes/FormSanitizer.php");
require_once("../assets/controller/classes/Constants.php");
require_once("../assets/controller/classes/Search.php");
require_once("../assets/controller/classes/Comment.php");


// =====================================

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/public/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/public/css/style.css" />
  <link rel="stylesheet" href="../assets/public/css/styleR.css">
  <script src="https://use.fontawesome.com/d8793cf2cc.js"></script>

  <!--================ ADD SOME META TAGS ==============-->
  <title>Chillix</title>
</head>

<body>
  <header>
    <div id="nothing" class="nothing"></div>
    <nav id="navigation" class="col-lg-12 navi_bar">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-3 logo-wrapper">
              <a href="main.php"><img id="logo" src="../assets/public/images/chillix.png" alt="Chillix motherfucking logo" /></a>
            </div>
            <div class="col-lg-9 navi">
              <ul class="row d-flex align-items-center">
                <li class="col-lg-3"><a href="main.php">Home</a></li>
                <li class="col-lg-3"><a href="#">must-see</a></li>
                <li class="col-lg-3">
                  <form>
                    <select name="movies" id="select-form" onchange="filterMovie(this.value)">
                      <option class="opt" value="">Genres</option>
                      <option class="opt" value="action">Action</option>
                      <option class="opt" value="crime">Crime</option>
                      <option class="opt" value="drama">Drama</option>
                      <option class="opt" value="mind-fuck">Mindfuck</option>
                    </select>
                  </form>
                </li>
                <li class="col-lg-3"><a href="#">Series</a></li>
              </ul>
              <div id="open-comment">leave a comment</div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <ul class="row d-flex align-items-center justify-content-end mr-lg-4">
            <li id="search-bar" class="mr-lg-3">
              <!----------SEARCH ------------>
              <form id="hint" class="d-flex align-items-center" method="POST" autocomplete="off">
                <i class="fa fa-search p-lg-1"></i>
                <input type="text" name="search" placeholder="Search your best shit..." autofocus onkeyup="getMovie(this.value)">
                <div id="movie-hint"></div>
                <button class="d-none" name="search_submit"></button>
              </form>
            </li>
            <?php
            if ($_SESSION["loggedin"]) {
              echo "<li id='user' class='col-lg-auto p-3'>" . $_SESSION["username"] . "</li>";
              echo "<li class='col-lg-auto p-3'><a href='logout.php'>out</a></li>";
            } else {
              echo "<li class='up col-lg-auto p-3'><a href='register.php'>up</a></li>";
              echo "<li class='col-lg-auto p-3'><a href='login.php'>in</a></li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron">
      <div class="iframe">
        <?php // DISPLAYING RECOMMENDED MOVIE 
        echo "<iframe src=" . $firstResult["link"] . "?autoplay=1 frameborder='0' allow='autoplay'></iframe>"; ?>
      </div>
      <div id='title' class="container pt-lg-5 ml-lg-3 d-flex flex-column justify-content-start">
        <div class="row">
          <?php echo "<div class='col-lg-auto mt-lg-4 font-weight-bold title'>" . $firstResult["title"] . "</div>"; ?>
        </div>
        <div class="row">
          <?php echo "<div class='col-lg-6 pt-lg-2 pb-lg-3 font-italic tagline'>" . $firstResult["overview"] . "</div>"; ?>
        </div>
        <div class="row">
          <?php
          if (fmod($firstResult["runtime"], 60) < 10) {
            $min = "0" . fmod($firstResult["runtime"], 60);
          } else {
            $min = fmod($firstResult["runtime"], 60);
          }
          echo "<div class='col-lg-auto runtime'>" . ROUND($firstResult["runtime"] / 60) . ":" . $min . " mins</div>"; ?>
        </div>

        <div class="row mt-lg-3">
          <button class="button col-lg-auto ml-lg-3">Play this</button>
          <button class="button col-lg-auto ml-lg-3">Know more?</button>
        </div>
      </div>
    </div>
  </header>
  <main class="main">
    <!----------- COMMENT SECTION------------->
    <div id="comment" class="container comment d-none">
      <div class="row">
        <div class="col-lg-12">
          <form class="comment-form" method="POST" action="">
            <input class="d-none" type="text" name="movie_id" <?php echo "value=" . $firstResult['movie_id'] . ">"; ?> </br> <input id="contenu" class="comment_content" name="comment_content" placeholder="Tell people how fucking amazing this movie is, will ya?">
            <button id="btn-send" name="comment_submit" />Send </button>
          </form>
          <div id="get-comment" class="comment-container col-lg-12 mt-lg-4">
            <div class="row comment-item mb-lg-4">
              <?php
              if ($comments->rowCount() == 0) {
                echo "<div class='col-lg-6 offset-lg-3'> No comments on this movie yet, please write one! </div>";
              } else {
                while ($comment = $comments->fetch()) {
                  echo "<div class='row comment-item mb-lg-4'>";
                  echo "<div class='user col-lg-1 offset-1 border-right'>" . $comment['username'] . "</div>";
                  echo "<div class='content col-lg-6'>" . $comment['content'] . "</div>";
                  echo "<div class='date-time col-lg-2'>" .  $comment['date_time'] .  "</div>";
                  echo "</div>";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!------------- MAIN ------------->
    <div class="container">
      <!---- SEARCH RESULTS ---->
      <?php
      if (isset($_POST["search_submit"])) {
        $funk->printSearchResult($results);
      }
      // RECOMMENDATIONS RESULTS
      $funk->printRecommedation(Constants::$sql_thriller);
      $funk->printRecommedation(Constants::$sql_drama);
      $funk->printRecommedation(Constants::$sql_action);
      $funk->printRecommedation(Constants::$sql_sciencefiction);
      $funk->printRecommedation(Constants::$sql_comedy);
      ?>
      <!---------FILTER ------>
  </main>
  <footer class="footer">
    <p><i class="fa fa-2x fa-github-square github_icon"></i></p>
    <div class="footer-cols">
      <ul>
        <li>Team :</li>
        <li><a href="#">Lap Hoang</a></li>
        <li><a href="#">Melissa Fruit</a></li>
        <li><a href="#">Frédéric Bembassat</a></li>
        <li><a href="#">Masato Deweerdt</a></li>
      </ul>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Terms Of Use</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="http://eepurl.com/hcMJ6L">Subscribe to Newsletter!</a></li>
      </ul>
      <ul>
        <li><a href="#">Account</a></li>
      </ul>
      <ul>
        <li>Becode</li>
      </ul>
    </div>

  </footer>
  <div class="media-query">
    OOPS! THIS WEBSITE IS NOT MEANT FOR SMALL SCREENS.
  </div>
  <script src="../assets/public/js/script.js"></script>
</body>

</html>