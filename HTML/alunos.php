<?php
session_start();
$conn = new mysqli("localhost", "root", "", "escola");

// Verifica conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Mensagem de sucesso
if (isset($_SESSION['mensagem'])) {
    echo "<p style='color:green;'>" . $_SESSION['mensagem'] . "</p>";
    unset($_SESSION['mensagem']);
}

// 🔽 SÓ MOSTRA SE CLICAR NO 👥
if (isset($_GET['lista']) && $_GET['lista'] == 'alunos') {

    $sql = "SELECT * FROM alunos";
    $result = $conn->query($sql);

    echo "<h2>Lista de Alunos</h2>";

    if ($result->num_rows > 0) {
        while ($aluno = $result->fetch_assoc()) {

            $nome = $aluno['nome'] ?? 'Não informado';
            $cpf = $aluno['cpf'] ?? 'Não informado';
            $email = $aluno['email'] ?? 'Não informado';
            $curso = $aluno['curso'] ?? 'Não informado';

            echo "<strong>Nome:</strong> $nome <br>";
            echo "<strong>CPF:</strong> $cpf <br>";
            echo "<strong>Email:</strong> $email <br>";
            echo "<strong>Curso:</strong> $curso <br>";

            echo "<a href='editar.php?id=".$aluno['id']."'>Editar</a>";

            echo "<hr>";
        }
    } else {
        echo "Nenhum aluno cadastrado.";
    }
}
?>