<?php
require_once 'config/Database.php';

class AtividadeDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM atividades");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM atividades WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($roteiro_id, $nome, $horario, $descricao) {
        $stmt = $this->conn->prepare(
            "INSERT INTO atividades (roteiro_id, nome, horario, descricao) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$roteiro_id, $nome, $horario, $descricao]);
    }

    public function atualizar($id, $roteiro_id, $nome, $horario, $descricao) {
        $stmt = $this->conn->prepare(
            "UPDATE atividades SET roteiro_id = ?, nome = ?, horario = ?, descricao = ? WHERE id = ?"
        );
        return $stmt->execute([$roteiro_id, $nome, $horario, $descricao, $id]);
    }

    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM atividades WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
