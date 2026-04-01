<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

getenv(...) ?: 'valor';

$hostname = getenv('DB_HOST') ?: 'crossover.proxy.rlwy.net';
$bancodedados = getenv('DB_NAME') ?: 'railway';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: 'lpZdolCpdlLPRFDHpvooJbHkwPSVDRYV';
$porta = getenv('DB_PORT') ?: '39659';

if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}

if (!extension_loaded('mysqli')) {
    throw new RuntimeException('Extensão mysqli não está disponível no servidor.');
}

$conn = new mysqli($hostname, $usuario, $senha, $bancodedados, $porta);

if ($conn->connect_error) {
    throw new RuntimeException('Erro de conexão: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');


