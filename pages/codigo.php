

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Codigo - Portal Academico</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>

<body>
    <header>
        <strong>Portal Academico</strong>
        <h1>Codigo de verificacao</h1>
        <p>Digite o codigo enviado no seu email.</p>
    </header>

    <main>
        <div class="right">
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
    </main>
    <script src="../assets/js/codigo.js"></script>
</body>

</html>
