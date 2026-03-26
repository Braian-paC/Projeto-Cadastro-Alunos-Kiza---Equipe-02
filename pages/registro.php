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
        
        <form method="POST" action="cadastrar.php" id="registerForm">

          <label class="cadastro">
            <input name="nome" type="text" id="nome" required placeholder="Nome completo" />
            <span id="nomeError" ></span>
          </label>
        
          <label class="cadastro">
            <input name="cpf" type="text" id="cpf" required placeholder="CPF"/>
            <span id="cpfError"></span>
          </label>

          <label class="cadastro">
            <input name="senha" type="password" id="senha" required placeholder="Senha" />
            <span id="senhaError"></span>
          </label>

          <label class="cadastro">
            <input name="confirm_senha" type="password" id="confirm_senha" required placeholder="Confirmar senha" />
            <span id="confirmSenhaError"></span>
          </label>

          <label class="cadastro">
            <input name="email" type="email" id="email" required placeholder="Email" />
            <span id="emailError"></span>
          </label>

          <button class="registro" type="submit">Registrar</button>

          <label class="check">
            <input type="checkbox" id="termos" name="termos" required />
            Eu aceito os <a href="termos.php">termos de uso</a>
          </label>
          <div>
            <span id="termosError"></span>
          </div>

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
  <script src="../assets/js/script.js"></script>
</body>
</html>