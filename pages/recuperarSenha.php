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

        <form method="post" id="formRecuperarSenha">

          <label for="email">Email</label>
          <input id="email" name="email" type="email" required placeholder="Email" />
          <span id="emailError" style="color: red; font-size: 12px;"></span>
          <button type="submit">Enviar</button>

        </form>

        <button type="button" onclick="location.href='login.php'">
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
<!-- Modal de código enviado -->
<div id="modalCodigoEnviado" style="display:none; position: fixed; top: 0; left: 0; width: 100%; 
height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
      <div style="background: white; padding: 20px; border-radius: 8px; text-align: center; max-width: 300px; color: black;">
      <h3>📧 Código enviado!</h3>
      <p>Verifique sua caixa de entrada.</p>
      <button id="fecharModalCodigo" style="margin-top: 10px; padding: 8px 16px; background: #4CAF50; color: white; border: none; border-radius: 4px;
      cursor: pointer;">OK</button>
      </div>
</div>

<script src="../assets/js/recuperar-senha.js"></script>
</body>
</html>
