<?php
include("../config/database.php");

// VALIDAÇÃO: campos vazios
if (empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirm_senha'])) {
    echo "Preencha todos os campos.";
    exit();
}

// VALIDAÇÃO: formato do email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "E-mail inválido.";
    exit();
}

// VALIDAÇÃO: tamanho mínimo da senha
if (strlen($_POST['senha']) < 6) {
    echo "A senha deve ter pelo menos 6 caracteres.";
    exit();
}

// VALIDAÇÃO: senhas iguais
if ($_POST['senha'] !== $_POST['confirm_senha']) {
    echo "As senhas não coincidem.";
    exit();
}

// VALIDAÇÃO: CPF tem 11 dígitos
$cpf = preg_replace('/\D/', '', $_POST['cpf']);
if (strlen($cpf) !== 11) {
    echo "CPF inválido.";
    exit();
}

// VALIDAÇÃO: email já cadastrado
$email = $conn->real_escape_string($_POST['email']);
$check = $conn->query("SELECT id FROM alunos WHERE email = '$email'");
if ($check->num_rows > 0) {
    echo "Este e-mail já está cadastrado.";
    exit();
}

// VALIDAÇÃO: CPF já cadastrado
$check_cpf = $conn->query("SELECT id FROM alunos WHERE cpf = '$cpf'");
if ($check_cpf->num_rows > 0) {
    echo "Este CPF já está cadastrado.";
    exit();
}

$nome         = $conn->real_escape_string($_POST['nome']);
$senha_hash   = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO alunos (nome, cpf, email, senha)
        VALUES ('$nome', '$cpf', '$email', '$senha_hash')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../pages/login.php");
    exit();
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>