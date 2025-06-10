<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../DAO/UsuarioDAO.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController {
    private $secretKey = 'segredo123'; // depois coloque no .env

    public function login($email, $senha) {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $payload = [
                'id' => $usuario['id'],
                'email' => $usuario['email'],
                'exp' => time() + 3600 // expira em 1 hora
            ];

            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
            echo json_encode(['token' => $jwt]);
        } else {
            http_response_code(401);
            echo json_encode(['erro' => 'Email ou senha inválidos']);
        }
    }

    public function validarToken($token) {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['erro' => 'Token inválido']);
            exit;
        }
    }

    public function proteger() {
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

        $this->validarToken($partes[1]);
    }
}
