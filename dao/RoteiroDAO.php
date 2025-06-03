<?php
require_once __DIR__ . '/../config/Database.php';

class RoteiroDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM roteiros");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM roteiros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($usuario_id, $destino, $dias, $descricao) {
        $stmt = $this->conn->prepare(
            "INSERT INTO roteiros (usuario_id, destino, dias, descricao) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$usuario_id, $destino, $dias, $descricao]);
    }

    public function atualizar($id, $usuario_id, $destino, $dias, $descricao) {
        $stmt = $this->conn->prepare(
            "UPDATE roteiros SET usuario_id = ?, destino = ?, dias = ?, descricao = ? WHERE id = ?"
        );
        return $stmt->execute([$usuario_id, $destino, $dias, $descricao, $id]);
    }

    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM roteiros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
