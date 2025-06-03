<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

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
