<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Portal Acadêmico</title>
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
    <header>
      <strong>Portal Acadêmico</strong>
      <h1>Bem-vindo</h1>
      <p>Faca login para acessar sua plataforma de estudos.</p>
    </header>

    <main>
      <div class="main">
        <div class="left">
          
          <form method="POST" action="/../services/loginService.php" id="formLogin">

            <label for="email">Email</label>
            <input
              id="email"
              name="email"
              type="email"
              placeholder="Digite seu email"
              required
            />
            <span id="email-error" style="color: red; font-size: 12px;"></span>

            <label for="senha">Senha</label>
            <input
              id="senha"
              name="senha"
              type="password"
              placeholder="Senha"
              required
            />
            <span id="erro-senha" style="color: red; font-size: 12px;"></span>

            <button type="submit">Entrar</button>

          </form>

          <div class="footer-links">
            <a href="recuperarSenha.php">Esqueci a senha</a>
            <a href="registro.php">Criar conta</a>
          </div>

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
    <script src="../assets/js/login.js"></script>
  </body>
</html>