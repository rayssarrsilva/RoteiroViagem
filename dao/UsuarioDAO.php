<?php
require_once __DIR__ . '/../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $email) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
        return $stmt->execute([$nome, $email]);
    }

    public function atualizar($id, $nome, $email) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $id]);
    }

    public function deletar($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>

service/UsuarioService.php
<?php
require_once 'dao/UsuarioDAO.php';

class UsuarioService {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function listar() {
        return $this->usuarioDAO->listarTodos();
    }

    public function buscar($id) {
        return $this->usuarioDAO->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->usuarioDAO->inserir($dados['nome'], $dados['email']);
    }

    public function atualizar($id, $dados) {
        return $this->usuarioDAO->atualizar($id, $dados['nome'], $dados['email']);
    }

    public function deletar($id) {
        return $this->usuarioDAO->deletar($id);
    }
}
?>
