<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperando senha</title>
    <link rel="stylesheet" href="./../../css/style.css">
</head>
<body>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './../../modulos/PHPMailer/src/Exception.php';
    require './../../modulos/PHPMailer/src/PHPMailer.php';
    require './../../modulos/PHPMailer/src/SMTP.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];  
        
        $mail = new PHPMailer(true);

    try {
        
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();   
        $mail->CharSet = "UTF-8";                                        
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'godlolpro32@gmail.com';
        $mail->Password = 'avmf upsc essi dscq';                              
        $mail->SMTPSecure = 'tls';      
        $mail->Port       = 587;                                   
    
       
        $mail->setFrom('naoresponda@hotmail.com', "Login System");
        $mail->addAddress($email, "Login System");

    
        $mail->isHTML(true);                                 
        $mail->Body = 'Você solicitou a recuperação de senha. Siga os próximos passos:
         ' . rand(100000, 999999);
        
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
    ?>

<form method="POST" action="recuperarsenha.php">
    <input type="text" name="email" placeholder="Digite seu e-mail" required>
    <button type="submit">Recuperar</button>
</form>

    <a href="./../../main.php">Voltar ao login</a>

</body>
</html>