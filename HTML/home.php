<?php
session_start();

// Proteção de login
if (!isset($_SESSION['usuario'])) {
    header("Location: Index.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal Acadêmico</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

<div class="dashboard">

  <!-- MENU LATERAL -->
  <aside class="sidebar">
    <a href="home.php" class="icon">🏠</a>
    <a href="home.php?lista=alunos" class="icon">👥</a>
    <a href="Index.php" class="icon">🚪</a>
  </aside>

  <!-- CONTEÚDO -->
  <main class="content">

    <h1>Portal Acadêmico | Bem-vindo</h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "escola");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // 🔽 MOSTRA LISTA SOMENTE QUANDO CLICAR NO 👥
    if (isset($_GET['lista']) && $_GET['lista'] == 'alunos') {

        echo "<h2>Lista de Alunos</h2>";

        $sql = "SELECT * FROM alunos";
        $result = $conn->query($sql);

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
    } else {
        // Tela inicial (quando não clicar no 👥)
        echo "<h2>Bem-vindo ao sistema</h2>";
    }
    ?>

    <!-- CARDS -->
    <div class="cards">

      <div class="card">
        <span>📖</span>
        <p>Meus cursos</p>
      </div>

      <div class="card">
        <span>📝</span>
        <p>Notas</p>
      </div>

      <div class="card">
        <span>📅</span>
        <p>Calendário</p>
      </div>

      <div class="card">
        <span>📚</span>
        <p>Biblioteca</p>
      </div>

    </div>

  </main>

</div>

</body>
</html>