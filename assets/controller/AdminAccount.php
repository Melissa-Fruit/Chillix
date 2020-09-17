<?php
// Méthode pour se connecter à la base de donnée désirée


if($_SESSION['logadmin']){
    if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
        $supprime = (int) $_GET['supprime'];
        $req = $con->prepare('DELETE FROM users WHERE id = ?');
        $req->execute(array($supprime));
    }
}

$users = $con->query("SELECT * FROM users ORDER BY id DESC");
$users->execute();


if (isset($_POST["submitButton"])) {

    $username = $_POST["username"];
    $pwd = $_POST["password"];
    // $pwd = hash("sha512", $pwd); 

    $stmt = $con->prepare("SELECT * FROM logadmin WHERE username = :username AND pwd = :pwd");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $_SESSION['logadmin'] = true;
        header("Location: administration.php");
    } else {
        echo "Username or Password is not correct!";
    }
}