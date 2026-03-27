<?php
$host    = 'localhost';
$banco   = 'nome_do_banco';  // troque pelo nome do seu banco
$usuario = 'root';           // troque pelo seu usuário
$senha   = '';               // troque pela sua senha

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8",
        $usuario,
        $senha
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}