<?php
session_start();
require_once('../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include __DIR__ . "/../config/database.php";

//Recebe email do formulario JS
$email = $_POST['email'] ?? '';
header('Content-Type: application/json');

if(empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email não foi informado']);
    exit;
}

//Verifica se o email exite no banco
$stmt = $conn->prepare("SELECT id FROM alunos WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
    exit;
} 

//Gerar código de 6 dígitos
$codigo = rand(100000, 999999);
$expira_em = date('Y-m-d H:i:s', strtotime('+1 hour'));

//Salva código no banco
$stmt = $conn->prepare("INSERT INTO recuperacao_senha (email, codigo, expira_em) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $email, $codigo, $expira_em);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar código']);
    exit;
}

//Configura e envia email

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'equipe2kizathon@gmail.com';
    $mail->Password = 'izcqkzwnmiflxonx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('equipe2kizathon@gmail.com', 'Portal acadêmico');
    $mail->addAddress($email);
    $mail->Subject = '🔐 Código de recuperação de senha';
    $mail->Body = "Seu código é: $codigo\n\nEste código expira em 1 hora.\n\nSe não solicitou, ignore este email";

    $mail->send();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao enviar email: ' . $mail->ErrorInfo]);
}
?>