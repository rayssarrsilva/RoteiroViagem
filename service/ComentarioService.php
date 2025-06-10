<?php
require_once _DIR_ . '/../dao/ComentarioDAO.php';

class ComentarioService {
    private $comentarioDAO;

    public function __construct() {
        $this->comentarioDAO = new ComentarioDAO();
    }

    public function listarPorRoteiro($roteiroId) {
        try {
            return $this->comentarioDAO->listarPorRoteiro($roteiroId);
        } catch (Exception $e) {
            return ["erro" => "Erro ao listar comentários."];
        }
    }

    public function criar($dados) {
        try {
            return $this->comentarioDAO->inserir($dados['roteiro_id'], $dados['autor'], $dados['comentario']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao criar comentário."];
        }
    }

    public function deletar($id) {
        try {
            return $this->comentarioDAO->deletar($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao deletar comentário."];
        }
    }
}