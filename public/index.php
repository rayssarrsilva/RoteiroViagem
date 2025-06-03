<?php
require_once '../controller/UsuarioController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// Exemplo: /usuarios ou /usuarios/1
$entidade = $uri[2] ?? null;
$id = $uri[3] ?? null;

$input = json_decode(file_get_contents('php://input'), true);

if ($entidade === 'usuarios') {
    $controller = new UsuarioController();
    $controller->processarRequisicao($_SERVER['REQUEST_METHOD'], $input, $id);
} else {
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada']);
}
?>
