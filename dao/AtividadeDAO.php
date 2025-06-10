<?php
require_once __DIR__ . '/../config/Database.php';

class AtividadeDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM atividades");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao listar atividades: " . $e->getMessage()];
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM atividades WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao buscar atividade: " . $e->getMessage()];
        }
    }

    public function inserir($roteiro_id, $nome, $horario, $descricao) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO atividades (roteiro_id, nome, horario, descricao) VALUES (?, ?, ?, ?)"
            );
            return $stmt->execute([$roteiro_id, $nome, $horario, $descricao]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao inserir atividade: " . $e->getMessage()];
        }
    }

    public function atualizar($id, $roteiro_id, $nome, $horario, $descricao) {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE atividades SET roteiro_id = ?, nome = ?, horario = ?, descricao = ? WHERE id = ?"
            );
            return $stmt->execute([$roteiro_id, $nome, $horario, $descricao, $id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao atualizar atividade: " . $e->getMessage()];
        }
    }

    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM atividades WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao deletar atividade: " . $e->getMessage()];
        }
    }
}
?>
