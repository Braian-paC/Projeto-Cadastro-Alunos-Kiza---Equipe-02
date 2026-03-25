<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nova senha - Portal Academico</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

  <header>
    <strong>Portal Academico</strong>
    <h1>Nova senha</h1>
    <p>Crie uma nova senha segura e confirme.</p>
  </header>

  <main>
    <div class="right">

      <section>
        <form action="Index.php" method="post">

          <label for="new-password">Nova senha</label>
          <input
            id="new-password"
            name="new-password"
            type="password"
            required
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&amp;])[A-Za-z\d@$!%*?&amp;]{8,}$"
          />

          <label for="confirm-password">Confirmar senha</label>
          <input
            id="confirm-password"
            name="confirm-password"
            type="password"
            required
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&amp;])[A-Za-z\d@$!%*?&amp;]{8,}$"
          />

          <button type="submit">Salvar e voltar</button>

        </form>
      </section>

      <button type="button" onclick="location.href='Index.php'">
        Voltar ao login
      </button>

    </div>
  </main>

</body>
</html>
