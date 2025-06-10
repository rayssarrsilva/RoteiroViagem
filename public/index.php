<?php
require_once '../controller/UsuarioController.php';
require_once '../controller/RoteiroController.php';
require_once '../controller/AtividadeController.php';
require_once '../controller/ComentarioController.php';
require_once '../controller/AuthController.php';
require_once '../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

$entidade = $uri[2] ?? null;
$id = $uri[3] ?? null;

$input = json_decode(file_get_contents('php://input'), true);

// Rota para login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entidade === 'login') {
    $dados = json_decode(file_get_contents("php://input"), true);
    $auth = new AuthController();
    $auth->login($dados['email'], $dados['senha']);
    exit;
}

// Rotas protegidas
switch ($entidade) {
    case 'usuarios':
        $controller = new UsuarioController();
        break;
    case 'roteiros':
        $controller = new RoteiroController();
        break;
    case 'atividades':
        $controller = new AtividadeController();
        break;
    case 'comentarios':
        $controller = new ComentarioController();
        break;
    default:
        http_response_code(404);
        echo json_encode(['erro' => 'Rota não encontrada']);
        exit;
}

$controller->processarRequisicao($_SERVER['REQUEST_METHOD'], $input, $id);
