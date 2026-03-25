<?php
require_once 'database.php';
require_once 'src/Services/AlunoService.php';

$alunoService = new AlunoService($conn);

$idParaDeletar = $_GET['id'] ?? null;

if ($idParaDeletar) {
    $resultado = $alunoService->deletarAluno($idParaDeletar);

    $_SESSION['mensagem'] = $resultado['mensagem'];

    header("Location: alunos.php");
    exit;
} else {
    header("Location: alunos.php");
    exit;
}
