<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos</title>
</head>
<body>
    <h1>Arquivo PHP criado.</h1>

    <form method="POST" action="codigo.php">
        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>