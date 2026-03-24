<?php
$conn = new mysqli("localhost", "root", "", "escola");

$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

while ($aluno = $result->fetch_assoc()) {
    echo $aluno['nome'] . " - " . $aluno['curso'];
    echo " <a href='editar.php?id=".$aluno['id']."'>Editar</a><br>";
}
?>