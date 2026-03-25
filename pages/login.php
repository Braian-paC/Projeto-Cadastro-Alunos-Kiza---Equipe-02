<?php
session_start();

// Conexão ao Banco de Dados.
include("../config/database.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

// Busca apenas pelo email
$sql = "SELECT * FROM alunos WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // 🔽 VERIFICA SENHA CRIPTOGRAFADA
    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $email;
        header("Location: home.php");
        exit();
    } else {
        echo "Senha incorreta";
    }
} else {
    echo "Usuário não encontrado";
}
?>