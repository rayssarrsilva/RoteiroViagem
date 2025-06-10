<?php
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JwtHelper {
    private static $chave = "sua_chave_secreta_aqui";

    public static function gerarToken($usuarioId) {
        $payload = [
            "iss" => "viagens-api",
            "iat" => time(),
            "exp" => time() + 3600,
            "uid" => $usuarioId
        ];
        return JWT::encode($payload, self::$chave, 'HS256');
    }

    public static function validarToken($token) {
        try {
            $decoded = JWT::decode($token, new Key(self::$chave, 'HS256'));
            return $decoded->uid;
        } catch (Exception $e) {
            throw new Exception("Token inválido.");
        }
    }
}
?>
