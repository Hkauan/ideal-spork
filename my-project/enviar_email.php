<?php
// Inclua os arquivos necessários do PHPMailer
require './libs/PHPMailer/PHPMailer/src/PHPMailer.php';
require './libs/PHPMailer/PHPMailer/src/SMTP.php';
require './libs/PHPMailer/PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP (Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'rededgeproz@gmail.com'; // Substitua pelo seu e-mail
        $mail->Password = '2305@Red'; // Substitua pela sua senha ou senha de aplicativo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuração do e-mail
        $mail->setFrom('rededgeproz@gmail.com', 'Contato RedEdge');
        $mail->addAddress('rededgeproz@gmail.com', 'RedEdge'); // Destinatário
        $mail->addReplyTo($email, $nome); // Para o remetente responder

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = "Novo contato de $nome";
        $mail->Body = "<h3>Detalhes do Contato:</h3>
                       <p><strong>Nome:</strong> $nome</p>
                       <p><strong>E-mail:</strong> $email</p>
                       <p><strong>Mensagem:</strong></p>
                       <p>$mensagem</p>";

        // Enviar o e-mail
        $mail->send();
        echo "<h2>E-mail enviado com sucesso!</h2>";
    } catch (Exception $e) {
        echo "<h2>Erro ao enviar e-mail: {$mail->ErrorInfo}</h2>";
    }
}
?>
