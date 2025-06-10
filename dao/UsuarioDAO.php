<?php
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        try {
            $stmt = $this->conn->query("SELECT * FROM usuarios");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao listar usuários: " . $e->getMessage()];
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao buscar usuário: " . $e->getMessage()];
        }
    }

    public function inserir($nome, $email) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
            return $stmt->execute([$nome, $email]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao inserir usuário: " . $e->getMessage()];
        }
    }

    public function atualizar($id, $nome, $email) {
        try {
            $stmt = $this->conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            return $stmt->execute([$nome, $email, $id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao atualizar usuário: " . $e->getMessage()];
        }
    }

    public function deletar($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao deletar usuário: " . $e->getMessage()];
        }
    }
}
?>
