<?php
session_start();
include('../config/database.php');

$codigo = $_POST['codigo'] ?? ''; //Recebe o codigo, se ele n existir retorna uma str vazia
header('Content-Type: application/json');

if (empty($codigo)) { //se o codigo nao existir...
    echo json_encode(['success' => false, 'message' => 'Digite o código.']);
    exit;
}

// Busca o código no banco PRIMEIRO
$stmt = $conn->prepare("SELECT email, expira_em, usado FROM recuperacao_senha WHERE codigo = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

// Se encontrou o código
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); //Converte o resultado em uma array associativa
    $expira_em = $row['expira_em']; //data/hora da expiracao do codigo
    $email = $row['email']; //Email que o usuario solicitou
    $usado = $row['usado']; // 1 para usado e 0 para...

    $agora = date('Y-m-d H:i:s');
    if ($agora > $expira_em) {
        echo json_encode(['success' => false, 'message' => 'Código expirado. Solicite um novo.']);
        $stmt = $conn->prepare("DELETE FROM recuperacao_senha WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        exit;
    }
    
    //Verifica se o codigo ja foi usado
    if ($usado == 1) {
    echo json_encode(['success' => false, 'message' => 'Código já utilizado. Solicite um novo!']);
    exit;
    }

    // Marca o código como usado, evita que o codigo seja usado outras vezes
    $stmt = $conn->prepare("UPDATE recuperacao_senha SET usado = 1 WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();

    // Guarda o email na sessão para ser usado na pagina de trocar senha
    $_SESSION['email_recuperacao'] = $email;
    echo json_encode(['success' => true]); //Informa ao js que o codigo foi validado
    exit;
}

// Se não encontrou o código ele retorna erro
echo json_encode(['success' => false, 'message' => 'Código inválido.']);
?>