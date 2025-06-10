<?php
require_once _DIR_ . '/../config/Database.php';

class ComentarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM comentarios");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao listar comentários: " . $e->getMessage()];
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM comentarios WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao buscar comentário: " . $e->getMessage()];
        }
    }

    public function inserir($roteiro_id, $autor, $comentario) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO comentarios (roteiro_id, autor, comentario) VALUES (?, ?, ?)"
            );
            return $stmt->execute([$roteiro_id, $autor, $comentario]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao inserir comentário: " . $e->getMessage()];
        }
    }

    public function atualizar($id, $roteiro_id, $autor, $comentario) {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE comentarios SET roteiro_id = ?, autor = ?, comentario = ? WHERE id = ?"
            );
            return $stmt->execute([$roteiro_id, $autor, $comentario, $id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao atualizar comentário: " . $e->getMessage()];
        }
    }

    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM comentarios WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao deletar comentário: " . $e->getMessage()];
        }
    }
}
?>
