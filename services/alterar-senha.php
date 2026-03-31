<?php
session_start();
include('../config/database.php');

$senha = $_POST['senha'] ?? '';
header('Content-Type: application/json');

if (empty($senha)) {
    echo json_encode(['success' => false, 'message' => 'Digite a nova senha.']);
    exit;
}

if(strlen($senha) < 8) {
    echo json_encode (['success' => false, 'message' => 'A senha deve ter pelo menos 8 caracteres.']);
    exit;
}

//Verifica se tem um email na sessão, calidação do código
if (!isset($_SESSION['email_recuperacao'])) {
    echo json_encode(['success' => false, 'message'=> 'Sessão inválida. Solicite um novo código']);
    exit;
}

$email = $_SESSION['email_recuperacao'];

//Criptografia da nova senha

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

//Atualiza a senha no banco
$stmt = $conn->prepare("UPDATE alunos SET senha = ? WHERE email = ?");
$stmt->bind_param("ss", $senha_hash, $email);

if ($stmt->execute()) {
    //Limpa a sessão
    unset($_SESSION['email_recuperacao']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao alterar a senha.']);
}


?>