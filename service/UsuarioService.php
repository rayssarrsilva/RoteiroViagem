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

controller/UsuarioController.php
<?php
require_once 'service/UsuarioService.php';

class UsuarioController {
    private $service;

    public function __construct() {
        $this->service = new UsuarioService();
    }

    public function processarRequisicao($metodo, $dados, $id = null) {
        header('Content-Type: application/json');

        switch ($metodo) {
            case 'GET':
                if ($id) {
                    echo json_encode($this->service->buscar($id));
                } else {
                    echo json_encode($this->service->listar());
                }
                break;

            case 'POST':
                echo json_encode($this->service->criar($dados));
                break;

            case 'PUT':
                echo json_encode($this->service->atualizar($id, $dados));
                break;

            case 'DELETE':
                echo json_encode($this->service->deletar($id));
                break;

            default:
                http_response_code(405);
                echo json_encode(['erro' => 'Método não permitido']);
        }
    }
}
?>