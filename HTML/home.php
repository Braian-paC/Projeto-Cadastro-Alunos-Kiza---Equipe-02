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
  <meta name="description" content="Login do portal academico" />
  <title>Portal Academico</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

  <div class="dashboard">

    <!-- MENU LATERAL -->
    <aside class="sidebar">
      <a href="home.php" class="icon">🏠</a>
      <div class="icon">👥</div>
      <a href="Index.php" class="icon">🚪</a>
    </aside>

    <!-- CONTEÚDO -->
    <main class="content">
      <h1>Portal Academico | Bem-vindo [Nome do aluno]</h1>
<?php
$conn = new mysqli("localhost", "root", "", "escola");

$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

echo "<h2>Lista de Alunos</h2>";

while ($aluno = $result->fetch_assoc()) {
    echo $aluno['nome'] . " - " . $aluno['curso'];
    echo " <a href='editar.php?id=".$aluno['id']."'>Editar</a><br>";
}
?>
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

