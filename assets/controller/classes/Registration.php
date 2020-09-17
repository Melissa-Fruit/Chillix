<?php
//cree une variable account qui fait appel a $con (qui se trouve dans config.php)
$account = new Account($con);


if(isset($_POST["submitButton"])){
    // la fonction est statique on l'apelle a l'aide de ::
    //$firstname = a la class FormSanitizer qui fait appelle grace au:: a la foncion statique sanitizeFormString ($_POST["firstName"]);
   $firstname = FormSanitizer:: sanitizeFormString ($_POST["firstName"]);
   $lastname = FormSanitizer:: sanitizeFormString ($_POST["lastName"]);
   $username = FormSanitizer:: sanitizeFormUsername ($_POST["username"]);
   $email = FormSanitizer:: sanitizeFormEmail ($_POST["email"]);
   $email2 = FormSanitizer:: sanitizeFormEmail ($_POST["email2"]);
   $password = FormSanitizer:: sanitizeFormPassword ($_POST["password"]);
   $password2 = FormSanitizer:: sanitizeFormPassword ($_POST["password2"]);

 $success = $account->register($firstname, $lastname, $username, $email, $email2, $password, $password2);

 if($success) {
     //store session = verifie que les entrée register sont true
     $_SESSION["loggedin"] = true;
     $_SESSION["username"] = $username;
     header("Location: main.php");
 }
}
function getInputvalue($name) {
    if(isset($_POST[$name])) {
         echo $_POST[$name];
    }
 }
