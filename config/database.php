<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$hostname = getenv('DB_HOST') ?: 'crossover.proxy.rlwy.net';
$bancodedados = getenv('DB_NAME') ?: 'railway';
$usuario = getenv('DB_USER') ?: 'root';
$senha = getenv('DB_PASS') ?: 'lpZdolCpdlLPRFDHpvooJbHkwPSVDRYV';
$porta = getenv('DB_PORT') ?: '39659';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($hostname, $usuario, $senha, $bancodedados, $porta);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log('[DB] Conexão falhou: ' . $e->getMessage());
    if (php_sapi_name() === 'cli') {
        throw $e; // útil para scripts em terminal
    }
    echo '<p style="color:red;">Erro de conexão com o banco de dados (ver console do servidor).</p>';
    echo '<p style="color:red;">Host: ' . htmlspecialchars($hostname) . ' / DB: ' . htmlspecialchars($bancodedados) . '</p>';
    exit;
}

if (isset($_SESSION['mensagem'])) {
    echo "<p style='color:green;'>" . $_SESSION['mensagem'] . "</p>";
    unset($_SESSION['mensagem']);
}