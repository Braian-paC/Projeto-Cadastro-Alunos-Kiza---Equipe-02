<?php
class AlunoService
{
    private $db;

    public function __construct($conexao)
    {
        $this->db = $conexao;
    }

    public function deletarAluno($id)
    {
        if (empty($id) || !is_numeric($id)) {
            return ["sucesso" => false, "mensagem" => "ID inválido."];
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM alunos WHERE id = ?");

            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    return ["sucesso" => true, "mensagem" => "Aluno removido com sucesso!"];
                } else {
                    return ["sucesso" => false, "mensagem" => "Aluno não encontrado."];
                }
            }

            return ["sucesso" => false, "mensagem" => "Erro ao executar a exclusão."];
        } catch (mysqli_sql_exception $e) {
            return ["sucesso" => false, "mensagem" => "Erro no banco: " . $e->getMessage()];
        }
    }
}
