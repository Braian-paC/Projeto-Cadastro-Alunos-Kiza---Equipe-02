

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Codigo - Portal Academico</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <header>
        <strong>Portal Academico</strong>
        <h1>Codigo de verificacao</h1>
        <p>Digite o codigo enviado no seu email.</p>
    </header>

    <main>
        <div class="right">
            <form action="nova-senha.php" method="post">

                <label>Codigo</label>
                <input 
                    type="text" 
                    name="codigo" 
                    pattern="\d{6}" 
                    maxlength="6" 
                    required
                    inputmode="numeric"
                    placeholder="000000"
                />

                <button type="submit">Confirmar</button>

            </form>

            <button type="button" onclick="location.href='Index.php'">
                Voltar ao login
            </button>

        </div>
    </main>
</body>

</html>
