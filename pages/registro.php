<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro - Portal Academico</title>
  <link rel="stylesheet" href="../assets/css/registro.css" />
  <link rel="stylesheet" href="../assets/css/layout.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
<!-- Modal de conseguir registrar -->
 <div id="modalSucesso" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);
 justify-content: center; align-items: center; z-index: 9999;">
 <div style="background: white; padding: 20px; border-radius: 8px; text-align: center; max-width: 300px; color: black;">
  <h3>✅ Cadastro realizado!</h3>
  <p>Seu cadastro foi concluído com sucesso.</p>
  <button id="fecharModal" style="margin-top: 10px; padding: 8px 16px; background: #4CAF50; color: white; border: none; border-radius: 4px;">OK</button>
 </div>
</div>
 
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
            <input name="cpf" type="text" id="cpf" maxlength="14" required placeholder="CPF"/>
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