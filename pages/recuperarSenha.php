<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recuperar senha - Portal Academico</title>
  <link rel="stylesheet" href="../assets/css/recuperarSenha.css" />
</head>

<body>

  <header>
    <strong>Portal Academico</strong>
    <h1>Recuperar senha</h1>
    <p>Informe seu email para receber o codigo de confirmacao.</p>
  </header>

  <main>
    <div class="new-password">
      <div class="left">

        <form action="codigo.php" method="post">

          <label for="email">Email</label>
          <input id="email" name="email" type="email" required placeholder="Email" />

          <button type="submit">Enviar</button>

        </form>

        <button type="button" onclick="location.href='Index.php'">
          Voltar ao login
        </button>

      </div>

      <div class="right">
        <section>
          <h2>Student Portal</h2>
          <p>Organize seus cursos, notas e calendarios em um unico lugar.</p>
          <img src="../assets/images/image-1-16.png" alt="Ilustracao de aluno" />
        </section>
      </div>
    </div>
  </main>

</body>
</html>
