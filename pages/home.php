<?php
session_start();
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
  <style>
    .busca-form {
      display: flex;
      gap: 8px;
      margin-bottom: 1.2rem;
    }
    .busca-form input[type="text"] {
      flex: 1;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    .busca-form input[type="text"]:focus {
      outline: none;
      border-color: #4f46e5;
    }
    .busca-form button {
      padding: 8px 16px;
      background: #4f46e5;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }
    .busca-form button:hover { background: #4338ca; }

    .aluno-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 10px;
    }
    .aluno-card p { margin: 2px 0; font-size: 14px; }
    .aluno-card a {
      display: inline-block;
      margin-top: 8px;
      font-size: 13px;
      color: #4f46e5;
      text-decoration: none;
    }
    .aluno-card a:hover { text-decoration: underline; }
    .resultado-count {
      font-size: 13px;
      color: #666;
      margin-bottom: 10px;
    }
    .sem-resultado {
      color: #999;
      font-size: 14px;
      padding: 1rem 0;
    }
  </style>
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
      include("../config/database.php");

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
                    <a href='editar.php?id={$aluno['id']}'>Editar</a>
                  </div>";
              }
          } else {
              echo "<p class='sem-resultado'>Nenhum aluno encontrado para \"" . htmlspecialchars($q) . "\".</p>";
          }

      } else {
          echo "<h2>Bem-vindo ao sistema</h2>";
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