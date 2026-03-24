<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Login do portal academico" />
    <title>Login - Portal Academico</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <header>
      <strong>Portal Academico</strong>
      <h1>Bem-vindo</h1>
      <p>Faca login para acessar sua plataforma de estudos.</p>
    </header>
    <main>
      <div class="main">
        <div class="left">
          <form>
            <label for="matricula">Matricula</label>
            <input
              id="matricula"
              name="matricula"
              type="text"
              placeholder="Digite sua matricula"
              required
            />
            <label for="senha">Senha</label>
            <input
              id="senha"
              name="senha"
              type="password"
              placeholder="Senha"
              required
              pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&amp;])[A-Za-z\d@$!%*?&amp;]{8,}$"
              title="A senha deve ter pelo menos 8 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais."
            />
            <button type="button" onclick="location.href = 'home.php'">
              Entrar
            </button>
            <div class="footer-links">
              <a href="recuperar-senha.php">Esqueci a senha</a>
              <a href="registro.php">Criar conta</a>
            </div>
          </form>
        </div>
        <div class="right">
          <section>
            <h2>Student Portal</h2>
            <p>Organize seus cursos, notas e calenderios em um unico lugar.</p>
            <img src="images/image-1-16.png" alt="Ilustracao de aluno" />
          </section>
        </div>
      </div>
    </main>
  </body>
</html>
