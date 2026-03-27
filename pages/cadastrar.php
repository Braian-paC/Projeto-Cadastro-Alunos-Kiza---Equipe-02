<?php

// Conexão ao Banco de Dados.
include("../config/database.php");

// Pega os dados
$nome = $_POST['nome'];
$cpf = preg_replace('/\D/', '', $_POST['cpf']); //Agora ele pega o cpf e tira as pontuações para poder economizar espaço na memória!
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirm_senha = $_POST['confirm_senha'];

// Verifica se senhas são iguais
if ($senha != $confirm_senha) {
    echo "As senhas não coincidem!";
    exit();
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// INSERT no banco
$sql = "INSERT INTO alunos (nome, cpf, email, senha)
VALUES ('$nome', '$cpf', '$email', '$senha_hash')";

if ($conn->query($sql) === TRUE) {
    header("Location: Index.php");
    exit();
} else {
    echo "Erro: " . $conn->error;
}
?>