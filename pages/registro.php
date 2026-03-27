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
<!-- Modal de termos de uso -->
 <div id="modalTermos" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: 
  center; align-items: center; z-index: 9999; ">
  <div style="background: white; padding: 20px; border-radius: 8px; max-width: 500px; max-height: 80%; overflow-y: auto; color: black;">
    <h1 style="font-size: 1.5rem;">Termos de uso</h1>
    <p>Este é um exemplo de termo de uso para o portal acadêmico.</p>

        <p><strong>1.</strong> Você concorda em usar o portal apenas para fins educacionais e respeitar as regras da instituição.</p>

        <p><strong>2.</strong> Sua matrícula e senha são pessoais; não compartilhe com terceiros.</p>

        <p><strong>3.</strong> Todos os dados devem ser utilizados de forma ética e segura.</p>

        <p><strong>4.</strong> A instituição pode monitorar acessos e uso para garantir segurança.</p>

        <p><strong>5.</strong> Ao prosseguir, você aceita esses termos.</p>
        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;"><button id="fecharModalTermos" style="padding: 8px 16px; background: #4CAF50;
         color: white; border: none; border-radius: 4px; cursor: pointer;">Fechar</button>
         </div>
  </div>
</div>

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
            Eu aceito os <a href="javascript:void(0);" id="abrirTermos">termos de uso</a>
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