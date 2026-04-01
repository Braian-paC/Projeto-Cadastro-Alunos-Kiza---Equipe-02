<?php
session_start();

// Para ver o erro que está acontecendo.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão ao Banco de Dados.
include __DIR__ . "/../config/database.php";

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
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit();
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Credenciais invalidas']); //Converte um array php em uma string no formato JSON
    }                                                                           //Fiz isso pq antes estava abrindo uma pagina em branco, agora posso fazer um interacao com o JS 
} else {
        header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Credenciais invalidas']);
}
?>