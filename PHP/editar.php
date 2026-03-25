<?php
$conn = new mysqli("localhost", "root", "", "escola");

$id = $_GET['id'];

$sql = "SELECT * FROM alunos WHERE id = $id";
$result = $conn->query($sql);
$aluno = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    $sql = "UPDATE alunos SET nome='$nome' WHERE id=$id";
    $conn->query($sql);

    header("Location: alunos.php");
}
?>

<form method="POST">
    <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>"><br>
    <button type="submit">Atualizar</button>
</form>