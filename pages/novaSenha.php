<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nova senha - Portal Academico</title>
  <link rel="stylesheet" href="../assets/css/novaSenha.css" />
</head>

<body>

  <header>
    <strong>Portal Acadêmico</strong>
    <h1>Nova senha</h1>
    <p>Crie uma nova senha segura e confirme.</p>
  </header>

  <main>
    <div class="left">

      <section>
        <form method="post"  id="formNovaSenha">

          <label for="senha">Nova senha</label>
          <input
            id="senha"
            name="senha"
            type="password"
            required
            placeholder="Nova Senha"
          />
          <span id="senhaError" style="color: red; font-size: 12px;"></span>

          <label for="confirmarSenha">Confirmar senha</label>
          <input
            id="confirmarSenha"
            name="confirmarSenha"
            type="password"
            required
            placeholder="Confirmar Senha"
          />
          <span id="confirmarError" style="color: red; font-size: 12px;"></span>

          <button type="submit">Salvar e voltar</button>

        </form>
      </section>

      <button type="button" onclick="location.href='login.php'">
        Voltar ao login
      </button>
    </div>

    <div class="right">
        <section>
          <h2>Student Portal</h2>
          <p>Organize seus cursos, notas e calendários em um único lugar.</p>
          <img src="../assets/images/image-1-16.png" alt="Ilustracao de aluno" />
        </section>
      </div>
      
  </main>
<script src="../assets/js/nova-senha.js"></script>
</body>
</html>
