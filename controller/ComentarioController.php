<?php
require_once 'service/ComentarioService.php';

class ComentarioController {
    private $service;

    public function __construct() {
        $this->service = new ComentarioService();
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
