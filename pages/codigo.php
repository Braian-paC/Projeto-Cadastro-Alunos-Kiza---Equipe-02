

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Codigo - Portal Academico</title>
    <link rel="stylesheet" href="../assets/css/codigo.css" />
</head>

<body>
    <header>
        <strong>Portal Acadêmico</strong>
        <h1>Codigo de verificação</h1>
        <p>Digite o código enviado no seu email.</p>
    </header>

    <main>
        <div class="left">
            <form action="novaSenha.php" method="post" id="formCodigo">

                <label>Codigo</label>
                <input 
                    type="text" 
                    id="codigo"
                    name="codigo" 
                    pattern="\d{6}" 
                    maxlength="6" 
                    required
                    inputmode="numeric"
                    placeholder="000000"
                />
                <span id="codigoError" style="color: red; font-size: 12px;"></span>

                <button type="submit">Confirmar</button>

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
    </main>
    <script src="../assets/js/codigo.js"></script>
</body>

</html>
