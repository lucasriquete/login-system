<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./css/style.css'>
</head>
<body>
    <h2>Login</h2>

<form method="POST" action="main.php">
    <input type="text" name="username" placeholder="Usuário" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
<p>Não tem conta? <a href="pages/cadastro/register.php">Cadastre-se</a></p>
<p>Esqueceu a senha? <a href="pages/recuperarsenha/recuperarsenha.php">Recuperar senha</a></p>
    <?php
        require 'inc/config.php';
        require 'inc/functions.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user['name'];
                    header("Location: pages/dashboard/dashboard.php");
                    exit;
                } else {
                    echo "<p style='color:red;'>Senha incorreta!</p>";
                }
            } else {
                echo "<p style='color:red;'>Usuário não encontrado!</p>";
            }
        }
        ?>
</body>
</html>