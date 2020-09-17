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
    <title>Administration Chillix</title>
</head>

<body>

    <h2>Administration System</h2>

    <ul>
    <?php while ($u = $users->fetch()) { ?>
            <li><?= $u['id'] ?> : <?= $u['username'] ?> - <a href="administration.php?supprime=<?= $u['id'] ?>">Supprimer</a></li>
        <?php } ?>
    </ul>

</body>

</html>