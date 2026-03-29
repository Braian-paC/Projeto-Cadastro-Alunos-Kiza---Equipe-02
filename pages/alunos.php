<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>TESTEEEE</h1>
    <?php
    session_start();

    // Conexão ao Banco de Dados.
    include("../config/database.php");

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

                echo "<a href='../services/editar.php?id=".$aluno['id']."'>Editar</a>";

                echo "<hr>";
            }
        } else {
            echo "Nenhum aluno cadastrado.";
        }
    }
    ?>
</body>
</html>