<?php
require_once '../controller/UsuarioController.php';
require_once '../controller/RoteiroController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Exemplo de rota: /usuarios ou /roteiros/1
$entidade = $uri[2] ?? null;
$id = $uri[3] ?? null;

$input = json_decode(file_get_contents('php://input'), true);

// Roteamento básico
switch ($entidade) {
    case 'usuarios':
        $controller = new UsuarioController();
        break;
    case 'roteiros':
        $controller = new RoteiroController();
        break;
    default:
        http_response_code(404);
        echo json_encode(['erro' => 'Rota não encontrada']);
        exit;
}

$controller->processarRequisicao($_SERVER['REQUEST_METHOD'], $input, $id);
?>
