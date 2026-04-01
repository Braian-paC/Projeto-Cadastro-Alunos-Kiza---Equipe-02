<?php
session_start();

// Forçar JSON em todas as saídas.
header('Content-Type: application/json; charset=UTF-8');

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', sys_get_temp_dir().'/php-error.log');

try {
    include __DIR__ . "/../config/database.php";
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno de conexão ao banco.', 'debug' => $e->getMessage()]);
    exit();
}

function json_fail($message, $status = 400) {
    http_response_code($status);
    echo json_encode(['success' => false, 'message' => $message]);
    exit();
}

if (empty($_POST['email']) || empty($_POST['senha'])) {
    json_fail('Preencha todos os campos.', 400);
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    json_fail('E-mail inválido.', 400);
}

if (strlen($_POST['senha']) < 6) {
    json_fail('A senha deve ter pelo menos 6 caracteres.', 400);
}

$email = $conn->real_escape_string($_POST['email']);
$senha = $_POST['senha'];

try {
    $sql = "SELECT * FROM alunos WHERE email = '$email'";
    $result = $conn->query($sql);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno no banco de dados.', 'debug' => $e->getMessage()]);
    exit();
}

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $email;
        echo json_encode(['success' => true]);
        exit();
    }
}

json_fail('E-mail ou senha incorretos.', 401);