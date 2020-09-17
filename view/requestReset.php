<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require_once("../assets/model/includes/config-local.php");
require_once("../assets/controller/classes/Reset.php");



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/public/css/styleR.css">
</head>
<body>

    <header class="showcase">
        <div class="showcase-top">
            <img src="../assets/public/images/chillix.png" alt="Chillix logo">
        </div>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="../assets/public/images/chillix.png" title="logo" alt="logo Chillix">
                <h3>Password reset</h3><br>
                <p>Please enter the email address associated with your user account. A verification code will be sent. When you receive it, you will be able to choose a new password</p>
            </div>
    
            <form method="POST" class="form">

            <input type="email" name="email" placeholder="Enter your email"  autocomplete="off">
            <br />
            <button type="submit" name="submitButton" value="Reset email">Submit</button>

            </form>
        
        </div>
    </div>


</body>
</html>