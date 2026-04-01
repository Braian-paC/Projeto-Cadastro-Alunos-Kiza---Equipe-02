<?php
require '../config/database.php';
# Classe responsável por gerenciar as operações de dados dos alunos. Isolamos a lógica de banco de dados aqui para manter o código organizado e facilitar a manutenção futura.
class AlunoService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    # Remove um aluno do banco de dados de forma segura. @param int|string $id O identificador único do aluno. @return array Retorna um array com o status ('sucesso') e a 'mensagem' do resultado.
    public function deletarAluno($id)
    {
        # 1. Validação de Segurança: Garante que o ID não está vazio e é um número
        if (empty($id) || !is_numeric($id)) {
            return ["sucesso" => false, "mensagem" => "ID inválido."];
        }

        try {
            # 2. Prepared Statement: Evita SQL Injection usando o marcador '?'
            $stmt = $this->conn->prepare("DELETE FROM alunos WHERE id = ?");

            # 3. Bind: Vincula o ID à consulta. O "i" indica que o valor é um Inteiro (integer)
            $stmt->bind_param("i", $id);

            # 4. Execução e Verificação
            if ($stmt->execute()) {
                # Verifica se alguma linha foi realmente removida do banco
                if ($stmt->affected_rows > 0) {
                    return ["sucesso" => true, "mensagem" => "Aluno removido com sucesso!"];
                } else {
                    return ["sucesso" => false, "mensagem" => "Aluno não encontrado."];
                }
            }

            return ["sucesso" => false, "mensagem" => "Erro ao executar a exclusão."];
        } catch (mysqli_sql_exception $e) {
            # Captura erros do MySQLi sem travar a aplicação
            return ["sucesso" => false, "mensagem" => "Erro no banco: " . $e->getMessage()];
        }
    }
}
