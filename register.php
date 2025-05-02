<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form method="POST">
        <h2>Cadastro de Novo Usuário</h2>
        <input name="name" placeholder="Nome completo" required>
        <input name="email" type="email" placeholder="E-mail" required>
        <input name="phone" placeholder="Telefone" required>
        <input name="username" placeholder="Usuário" required>
        <input name="password" type="password" placeholder="Senha" required>
        <button type="submit">Criar conta</button>
    </form>
    <br>
    <a href="index.php">Voltar ao login</a>
    <?php
require 'inc/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);
    $username = trim($_POST['username']);
    $rawPass  = $_POST['password'];

    // Validação simples de senha
    if (strlen($rawPass) < 6) {
        echo "<p style='color:red;'>A senha deve ter pelo menos 6 caracteres!</p>";
        exit;
    }

    // Verifica se o e-mail já existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "<p style='color:red;'>Este e-mail já está em uso!</p>";
        exit;
    }

    // Verifica se o username já existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "<p style='color:red;'>Este nome de usuário já está em uso!</p>";
        exit;
    }

    // Se passou em tudo, continua o cadastro
    $password = password_hash($rawPass, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, username, password) VALUES (?, ?, ?, ?, ?)");

    try {
        $stmt->execute([$name, $email, $phone, $username, $password]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>