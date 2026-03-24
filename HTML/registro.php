<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro - Portal Academico</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<body>

  <header>
    <strong>Portal Academico</strong>
    <h1>Registre-se</h1>
    <p>Crie sua conta para acessar o portal.</p>
  </header>

  <main>
    <div class="main">

      <!-- FORMULÁRIO -->
      <div class="left">
        <form action="registro.php" method="post">

          <label for="matricula">Matricula</label>
          <input id="matricula" name="matricula" type="text" required />

          <label for="email">Email</label>
          <input id="email" name="email" type="email" required />

          <label for="senha">Senha</label>
          <input id="senha" name="senha" type="password" required />

          <label for="confirm-senha">Confirmar senha</label>
          <input
            id="confirm-senha"
            name="confirm-senha"
            type="password"
            required
            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&amp;])[A-Za-z\d@$!%*?&amp;]{8,}$"
          />

          <label for="telefone">Telefone</label>
          <input id="telefone" name="telefone" type="tel" required />

          <label>
            <input type="checkbox" required />
            Eu aceito os <a href="termos.php">termos de uso</a>
          </label>

          <button type="submit">Registrar</button>

        </form>

        <button type="button" onclick="location.href='Index.php'">
          Voltar ao login
        </button>
      </div>

      <!-- IMAGEM -->
      <div class="right">
        <img src="images/image-1-16.png" alt="Ilustração" />
      </div>

    </div>
  </main>

</body>
</html>
