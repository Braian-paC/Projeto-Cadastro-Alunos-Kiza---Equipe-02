<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Conexão ao Banco de Dados.
include("../config/database.php");

// Verifica ID
if (!isset($_GET['id'])) {
    die("ID não informado");
}

$id = (int) $_GET['id'];

// Busca aluno
$sql = "SELECT * FROM alunos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Aluno não encontrado");
}

$aluno = $result->fetch_assoc();

// Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $senha = $_POST['senha'];

    if (!empty($senha)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    } else {
        $senhaHash = $aluno['senha'];
    }

    $sql = "UPDATE alunos SET 
            nome='$nome', 
            cpf='$cpf', 
            email='$email', 
            curso='$curso', 
            senha='$senhaHash' 
            WHERE id=$id";

    $conn->query($sql);

    $_SESSION['mensagem'] = "Aluno atualizado com sucesso!";
    header("Location: alunos.php");
    exit();
}
?>

<!-- FORMULÁRIO -->
<h2>Editar Aluno</h2>

<form method="POST">
    Nome:<br>
    <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>"><br><br>

    CPF:<br>
    <input type="text" name="cpf" value="<?php echo $aluno['cpf']; ?>"><br><br>

    Email:<br>
    <input type="text" name="email" value="<?php echo $aluno['email']; ?>"><br><br>

    Curso:<br>
    <input type="text" name="curso" value="<?php echo $aluno['curso']; ?>"><br><br>

    Senha (deixe vazio para manter):<br>
    <input type="password" name="senha"><br><br>

    <button type="submit">Atualizar</button><br><br>

    <a href="Delete/Delete.php?id=<?php echo $aluno['id']; ?>" onclick="return confirm('Deseja realmente excluir?');"
        style="background-color: #ff4d4d; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;">
        Excluir
    </a>
</form>