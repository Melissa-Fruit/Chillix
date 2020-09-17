<?php
// pour connecter a la base de données
require_once("../assets/model/includes/config-local.php");

//Pour acceder au classes php faire appel au dossier classes/.php avec require_once
require_once("../assets/controller/classes/FormSanitizer.php");
//recupere via isset les donées du form via le submit du boutton et 
//utilise la fonction crée pour sanitize, elle se trouve dans le dossier includes/classes/FormSanitizer.php

//pour acceder a Account.php
require_once("../assets/controller/classes/Account.php");

require_once("../assets/controller/classes/Registration.php");
//pour acceder a Constants.php
require_once("../assets/controller/classes/Constants.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/public/css/styleR.css"> 
   
    <title>Chillix</title>
</head>
<body>
   <div class = "signInContainer">

        <div class = "column">

            <div class= "header">
                <img src="../assets/public/images/chillix.png" title="logo" alt="logo Chillix"> 
                    <h3>Sign Up</h3>
                    <span>to continue to Chillix</span>  
                 
            </div>

            <form method="POST">

            <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="firstName" placeholder="First name"  value="<?php getInputvalue("firstName");?>" required>
            <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="lastName" placeholder="Last name"  value="<?php getInputvalue("lastName");?>" required>
            <?php echo $account->getError(Constants::$userNameCharacters); ?>
            <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="text" name="username" placeholder="Username"  value="<?php getInputvalue("username");?>" required>
            <?php echo $account->getError(Constants::$emailsDontMatch); ?> 
            <?php echo $account->getError(Constants::$emailInvalid); ?>   
            <?php echo $account->getError(Constants::$emailTaken); ?>  
                <input type="email" name="email" placeholder="Email"  value="<?php getInputvalue("email");?>" required>
                <input type="email" name="email2" placeholder="Confirm email"  value="<?php getInputvalue("email2");?>" required>
            <?php echo $account->getError(Constants::$passwordsDontMatch); ?> 
            <?php echo $account->getError(Constants::$passwordLength); ?> 
                <input type="password" name="password" placeholder="Password" required>

                <input type="password" name="password2" placeholder="Confirm password" required>

                <input type="submit" name="submitButton" value="SUBMIT">


            </form>
            <a href="login.php" class= "signInMessage">Already have an account? Sign in here!</a>
 
        </div>

   </div>
<!--  http://localhost/Chillix-mvc/view/register.php   -->
</body>
</html>



