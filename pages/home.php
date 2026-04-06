<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal Acadêmico</title>
  <link rel="stylesheet" href="../assets/css/home.css" />
</head>
<body>
<div class="dashboard">

  <h1>Portal Acadêmico | Bem-vindo</h1>

  <!-- CONTEÚDO -->
  <main class="content">

    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <a href="home.php" class="icon">🏠</a>
      <a href="home.php?lista=alunos" class="icon">👥</a>
      <a href="login.php" class="icon">🚪</a>
    </aside>

    <?php
      include __DIR__ . "/../config/database.php";

      if (isset($_GET['lista']) && $_GET['lista'] == 'alunos') {

          // Pega o termo de busca (vazio se não digitou nada)
          $q = isset($_GET['q']) ? trim($_GET['q']) : '';
          $q_seguro = $conn->real_escape_string($q);

          echo "<h2>Lista de Alunos</h2>";

          // Formulário de busca (mantém ?lista=alunos na URL)
          echo '
          <form class="busca-form" method="GET">
            <input type="hidden" name="lista" value="alunos">
            <input type="text" name="q"
                   value="' . htmlspecialchars($q) . '"
                   placeholder="Buscar por nome ou CPF…">
            <button type="submit">Buscar</button>
          </form>';

          // Monta a query: se digitou algo, filtra; senão, traz todos
          if ($q_seguro !== '') {
              $sql = "SELECT * FROM alunos
                      WHERE nome LIKE '%$q_seguro%'
                         OR cpf  LIKE '%$q_seguro%'
                      ORDER BY nome";
          } else {
              $sql = "SELECT * FROM alunos ORDER BY nome";
          }

          $result = $conn->query($sql);

          echo '<p class="resultado-count">' . $result->num_rows . ' aluno(s) encontrado(s)</p>';

          if ($result->num_rows > 0) {
              while ($aluno = $result->fetch_assoc()) {
                  $nome  = htmlspecialchars($aluno['nome']  ?? 'Não informado');
                  $cpf   = htmlspecialchars($aluno['cpf']   ?? 'Não informado');
                  $email = htmlspecialchars($aluno['email'] ?? 'Não informado');
                  $curso = htmlspecialchars($aluno['curso'] ?? 'Não informado');

                  echo "
                  <div class='aluno-card'>
                    <p><strong>Nome:</strong> $nome</p>
                    <p><strong>CPF:</strong> $cpf</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Curso:</strong> $curso</p>
                    <a href='/../services/editar.php?id={$aluno['id']}'>Editar</a>
                  </div>";
              }
          } else {
              echo "<p class='sem-resultado'>Nenhum aluno encontrado para \"" . htmlspecialchars($q) . "\".</p>";
          }
      }
    ?>

    <!-- CARDS -->
    <div class="cards">
      <div class="card"><span>📖</span><p>Meus cursos</p></div>
      <div class="card"><span>📝</span><p>Notas</p></div>
      <div class="card"><span>📅</span><p>Calendário</p></div>
      <div class="card"><span>📚</span><p>Biblioteca</p></div>
    </div>

  </main>
</div>
</body>
</html>