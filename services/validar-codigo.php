<?php
session_start();
include('../config/database.php');

$codigo = $_POST['codigo'] ?? '';
header('Content-Type: application/json');

if (empty($codigo)) {
    echo json_encode(['success' => false, 'message' => 'Digite o código.']);
    exit;
}

//Limpar codigo expirado
$stmt = $conn->prepare("DELETE FROM recuperacao_senha WHERE expira_em < NOW()");
$stmt->execute();

// Busca o código no banco
$stmt = $conn->prepare("SELECT email, expira_em FROM recuperacao_senha WHERE codigo = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Código inválido.']);
    exit;
}

$row = $result->fetch_assoc();
$expira_em = $row['expira_em'];
$email = $row['email'];

// Verifica se o código expirou
$agora = date('Y-m-d H:i:s');
if ($agora > $expira_em) {
    echo json_encode(['success' => false, 'message' => 'Código expirado. Solicite um novo.']);
    exit;
}

// Marca o código como usado
$stmt = $conn->prepare("UPDATE recuperacao_senha SET usado = 1 WHERE codigo = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();

// Guarda o email na sessão
$_SESSION['email_recuperacao'] = $email;

echo json_encode(['success' => true]);

?>

