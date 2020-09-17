<?php
// pour connecter a la base de données
require_once("../assets/model/includes/config-local.php");
// pour connecter a requestReset.php
require_once("../assets/controller/classes/Reset.php");


    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/public/css/styleR.css">
        <title>Document</title>
    </head>
    <body>
    <form method="POST">

<input type="password" name="password" placeholder="New password">
<br />
<input type="submit" name="submit" value="Update password">


</form>
</body>
</html>