<?php
require_once __DIR__ . '/../config/Database.php';

class ComentarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM comentarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM comentarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($roteiro_id, $autor, $comentario) {
        $stmt = $this->conn->prepare(
            "INSERT INTO comentarios (roteiro_id, autor, comentario) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$roteiro_id, $autor, $comentario]);
    }

    public function atualizar($id, $roteiro_id, $autor, $comentario) {
        $stmt = $this->conn->prepare(
            "UPDATE comentarios SET roteiro_id = ?, autor = ?, comentario = ? WHERE id = ?"
        );
        return $stmt->execute([$roteiro_id, $autor, $comentario, $id]);
    }

    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM comentarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
