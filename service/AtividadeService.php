<?php
require_once 'dao/AtividadeDAO.php';

class AtividadeService {
    private $atividadeDAO;

    public function __construct() {
        $this->atividadeDAO = new AtividadeDAO();
    }

    public function listar() {
        return $this->atividadeDAO->listarTodos();
    }

    public function buscar($id) {
        return $this->atividadeDAO->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->atividadeDAO->inserir(
            $dados['roteiro_id'],
            $dados['nome'],
            $dados['horario'],
            $dados['descricao']
        );
    }

    public function atualizar($id, $dados) {
        return $this->atividadeDAO->atualizar(
            $id,
            $dados['roteiro_id'],
            $dados['nome'],
            $dados['horario'],
            $dados['descricao']
        );
    }

    public function deletar($id) {
        return $this->atividadeDAO->deletar($id);
    }
}
?>
