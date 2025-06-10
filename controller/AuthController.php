<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';
require_once __DIR__ . '/../model/JwtHelper.php';

class AuthController {
    public function login($dados) {
        $dao = new UsuarioDAO();
        $usuario = $dao->buscarPorEmail($dados["email"]);

        if ($usuario && password_verify($dados["senha"], $usuario["senha"])) {
            $token = JwtHelper::gerarToken($usuario["id"]);
            echo json_encode(["token" => $token]);
        } else {
            http_response_code(401);
            echo json_encode(["erro" => "Credenciais inválidas"]);
        }
    }

    public static function proteger() {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['erro' => 'Token não enviado']);
            exit;
        }

        $partes = explode(' ', $headers['Authorization']);
        if (count($partes) !== 2 || $partes[0] !== 'Bearer') {
            http_response_code(401);
            echo json_encode(['erro' => 'Formato inválido do token']);
            exit;
        }

        try {
            JwtHelper::validarToken($partes[1]);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['erro' => $e->getMessage()]);
            exit;
        }
    }
}