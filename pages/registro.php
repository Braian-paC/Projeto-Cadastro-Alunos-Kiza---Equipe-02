<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro - Portal Academico</title>
  <link rel="stylesheet" href="../assets/css/registro.css" />
</head>

<body>

  <main>
    <div class="main">

      <div class="left">
        <div>
          <h1>Registre-se</h1>
          <p>Crie sua conta para acessar o portal.</p>
        </div>
        
        <form method="POST" action="cadastrar.php">

          <label class="cadastro">
            <input name="nome" type="text" required placeholder="Nome completo" />
          </label>
        
          <label class="cadastro">
            <input name="cpf" type="text" required placeholder="CPF"/>
          </label>

          <label class="cadastro">
            <input name="senha" type="password" required placeholder="Senha" />
          </label>

          <label class="cadastro">
            <input name="confirm_senha" type="password" required placeholder="Confirmar senha" />
          </label>

          <label class="cadastro">
            <input name="email" type="email" required placeholder="Email" />
          </label>

          <button class="registro" type="submit">Registrar</button>

          <label class="check">
            <input type="checkbox" name="termos" required />
            Eu aceito os <a href="termos.php">termos de uso</a>
          </label>

        </form>

        <button onclick="location.href='Index.php'">
          Voltar ao login
        </button>

      </div>
    </div>
  </main>
 

  <div class="right">
    <h1>Portal Acadêmico</h1>
    <img src="../assets/images/image-1-16.png" alt="Ilustração" />
  </div>

</body>
</html>