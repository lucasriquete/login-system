<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    function redirectIfNotLoggedIn() {
        if (!isLoggedIn()) {
            header("Location: index.php");
            exit;
        }
    }
    ?>
</body>
</html>