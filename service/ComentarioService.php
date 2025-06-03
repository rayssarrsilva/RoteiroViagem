<?php
require_once 'dao/ComentarioDAO.php';

class ComentarioService {
    private $comentarioDAO;

    public function __construct() {
        $this->comentarioDAO = new ComentarioDAO();
    }

    public function listar() {
        return $this->comentarioDAO->listarTodos();
    }

    public function buscar($id) {
        return $this->comentarioDAO->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->comentarioDAO->inserir(
            $dados['roteiro_id'],
            $dados['autor'],
            $dados['comentario']
        );
    }

    public function atualizar($id, $dados) {
        return $this->comentarioDAO->atualizar(
            $id,
            $dados['roteiro_id'],
            $dados['autor'],
            $dados['comentario']
        );
    }

    public function deletar($id) {
        return $this->comentarioDAO->deletar($id);
    }
}
?>
