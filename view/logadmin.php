<?php
session_start();

require_once("../assets/model/includes/config.php");
require_once("../assets/controller/classes/AdminAccount.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/public/css/logadmin.css" rel="stylesheet">
    <title>Login Administration Chillix</title>
</head>

<body>

    <div id="container">

        <form method="POST">

            <h2>Login for the administration system</h2>

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" name="submitButton" value="SUBMIT">

        </form>

    </div>

</body>

</html>