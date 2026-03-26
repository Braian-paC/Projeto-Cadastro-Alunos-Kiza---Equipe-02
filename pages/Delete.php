<?php
require_once '../config/database.php';
require_once 'AlunoService.php';

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