<?php
require_once __DIR__ . '/../service/RoteiroService.php';
require_once __DIR__ . '/../controller/AuthController.php'; 

class RoteiroController {
    private $service;

    public function __construct() {
        $this->service = new RoteiroService();
    }

    public function processarRequisicao($metodo, $dados, $id = null) {
        header('Content-Type: application/json');

        $auth = new AuthController();

        switch ($metodo) {
            case 'GET':
                if ($id) {
                    echo json_encode($this->service->buscar($id));
                } else {
                    echo json_encode($this->service->listar());
                }
                break;

            case 'POST':
            case 'PUT':
            case 'DELETE':
                $auth->proteger(); // 🔐 Protege essas ações
                break;
        }

        switch ($metodo) {
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
