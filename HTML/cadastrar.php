<?php
$conn = new mysqli("localhost", "root", "", "escola");

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se aceitou os termos
if (!isset($_POST['termos'])) {
    echo "Você precisa aceitar os termos!";
    exit();
}

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