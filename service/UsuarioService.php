<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioService {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function listar() {
        try {
            return $this->usuarioDAO->listarTodos();
        } catch (Exception $e) {
            return ["erro" => "Erro interno ao listar usuários."];
        }
    }

    public function buscar($id) {
        try {
            return $this->usuarioDAO->buscarPorId($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao buscar usuário."];
        }
    }

    public function criar($dados) {
        try {
            return $this->usuarioDAO->inserir($dados['nome'], $dados['email']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao criar usuário."];
        }
    }

    public function atualizar($id, $dados) {
        try {
            return $this->usuarioDAO->atualizar($id, $dados['nome'], $dados['email']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao atualizar usuário."];
        }
    }

    public function deletar($id) {
        try {
            return $this->usuarioDAO->deletar($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao deletar usuário."];
        }
    }
}
