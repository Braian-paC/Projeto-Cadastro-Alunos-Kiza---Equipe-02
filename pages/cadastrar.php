<?php

// Conexão ao Banco de Dados.
include("../config/database.php");

// Pega os dados
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirm_senha = $_POST['confirm_senha'];

// Verifica se senhas são iguais
if ($senha != $confirm_senha) {
    echo "As senhas não coincidem!";
    exit();
}

// INSERT no banco
$sql = "INSERT INTO alunos (nome, cpf, email, senha)
VALUES ('$nome', '$cpf', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    header("Location: Index.php");
    exit();
} else {
    echo "Erro: " . $conn->error;
}
?>