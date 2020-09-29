<?php $account = new Account($con);

if (isset($_POST["submitButton"])) {

    $username = $_POST["username"];
    $pwd = $_POST["password"];

    $success = $account->login($pwd, $username);

    if ($success) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: main.php");
    }
}