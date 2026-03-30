<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail-> SMTPDebug = SMTP::DEBUG_SERVER;
    $mail-> isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'teste@gmail.com';
    $mail->Password = '1234';
    $mail->Port = 587;
    
    $mail->setFrom('teste@gmail.com');
    $mail->addAddress('teste@gmail.com');

} catch (Exception) {
    echo "Erro ao enviar msg: {$mail->ErrorInfo}";
}
?>