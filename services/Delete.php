<?php
// 1. Conecta ao banco (subindo duas pastas para achar a 'config')
require_once '../config/database.php';

// 2. Importa a lógica do serviço (está na mesma pasta)
require_once 'AlunoService.php';

// 3. Inicia o serviço passando a conexão $conn que vem do database.php
$AlunoService = new AlunoService($conn);

// 4. Pega o ID que veio do botão
$idParaDeletar = $_GET['id'] ?? null;

// ... código anterior do Delete.php ...

if ($idParaDeletar) {
    $resultado = $AlunoService->deletarAluno($idParaDeletar);
    $_SESSION['mensagem'] = $resultado['mensagem'];

    // Redireciona automaticamente para a Home (subindo uma pasta)
    header("Location: ../pages/home.php");
    exit;
} else {
    header("Location: ../pages/home.php");
    exit;
}
