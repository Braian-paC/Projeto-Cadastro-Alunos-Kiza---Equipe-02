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

      <div class="left">

        
        <form method="POST" action="cadastrar.php">

        <label>Nome completo</label>
        <input name="nome" type="text" required />

        
          <label>CPF</label>
          <input name="cpf" type="text" required />

          <label>Senha</label>
          <input name="senha" type="password" required />

          <label>Confirmar senha</label>
          <input name="confirm_senha" type="password" required />

          <label>Email</label>
          <input name="email" type="email" required />

          <button type="submit">Registrar</button>

          <label>
      <input type="checkbox" name="termos" required />
       Eu aceito os <a href="termos.php">termos de uso</a>
          </label>

        </form>

        <button onclick="location.href='Index.php'">
          Voltar ao login
        </button>

      </div>

      <div class="right">
        <img src="images/image-1-16.png" alt="Ilustração" />
      </div>

    </div>
  </main>

</body>
</html>