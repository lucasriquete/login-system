<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo</title>
</head>
<body>
    <?php
    require './../../inc/functions.php';
    redirectIfNotLoggedIn();
    ?>
    <h1>Bem-vindo, <?= $_SESSION['user'] ?>!</h1>
    <a href="./../logout/logout.php">Sair</a>
</body>
</html>