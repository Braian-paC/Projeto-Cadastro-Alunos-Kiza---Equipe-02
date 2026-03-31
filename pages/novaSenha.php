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
        <form method="post"  id="formNovaSenha">

          <label for="senha">Nova senha</label>
          <input
            id="senha"
            name="senha"
            type="password"
            required
          />
          <span id="senhaError" style="color: red; font-size: 12px;"></span>

          <label for="confirmarSenha">Confirmar senha</label>
          <input
            id="confirmarSenha"
            name="confirmarSenha"
            type="password"
            required
          />
          <span id="confirmarError" style="color: red; font-size: 12px;"></span>

          <button type="submit">Salvar e voltar</button>

        </form>
      </section>

      <button type="button" onclick="location.href='login.php'">
        Voltar ao login
      </button>

    </div>
  </main>
<script src="../assets/js/nova-senha.js"></script>
</body>
</html>
