<?php
session_start();

$conn = new mysqli("localhost", "root", "", "escola");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM alunos WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    if ($senha == $usuario['senha']) { 
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