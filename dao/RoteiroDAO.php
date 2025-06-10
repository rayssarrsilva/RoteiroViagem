<?php
require_once _DIR_ . '/../config/Database.php';

class RoteiroDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM roteiros");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao listar roteiros: " . $e->getMessage()];
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM roteiros WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao buscar roteiro: " . $e->getMessage()];
        }
    }

    public function inserir($usuario_id, $destino, $dias, $descricao) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO roteiros (usuario_id, destino, dias, descricao) VALUES (?, ?, ?, ?)"
            );
            return $stmt->execute([$usuario_id, $destino, $dias, $descricao]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao inserir roteiro: " . $e->getMessage()];
        }
    }

    public function atualizar($id, $usuario_id, $destino, $dias, $descricao) {
        try {
            $stmt = $this->conn->prepare(
                "UPDATE roteiros SET usuario_id = ?, destino = ?, dias = ?, descricao = ? WHERE id = ?"
            );
            return $stmt->execute([$usuario_id, $destino, $dias, $descricao, $id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao atualizar roteiro: " . $e->getMessage()];
        }
    }

    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM roteiros WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao deletar roteiro: " . $e->getMessage()];
        }
    }
}
?>
