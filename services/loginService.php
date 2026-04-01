<?php
session_start();

// Para ver o erro que está acontecendo.
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__.'/../logs/php-error.log');

// Conexão ao Banco de Dados.
include __DIR__ . "/../config/database.php";

// VALIDAÇÃO: campos vazios
if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos.']);
    exit();
}

// VALIDAÇÃO: formato do email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'E-mail inválido.']);
    exit();
}

// VALIDAÇÃO: tamanho mínimo da senha
if (strlen($_POST['senha']) < 6) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'A senha deve ter pelo menos 6 caracteres.']);
    exit();
}

$email = $conn->real_escape_string($_POST['email']);
$senha = $_POST['senha'];

$sql    = "SELECT * FROM alunos WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $email;
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'E-mail ou senha incorretos.']);
exit();
?>