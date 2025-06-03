<?php
require_once 'dao/RoteiroDAO.php';

class RoteiroService {
    private $roteiroDAO;

    public function __construct() {
        $this->roteiroDAO = new RoteiroDAO();
    }

    public function listar() {
        return $this->roteiroDAO->listarTodos();
    }

    public function buscar($id) {
        return $this->roteiroDAO->buscarPorId($id);
    }

    public function criar($dados) {
        return $this->roteiroDAO->inserir(
            $dados['usuario_id'],
            $dados['destino'],
            $dados['dias'],
            $dados['descricao']
        );
    }

    public function atualizar($id, $dados) {
        return $this->roteiroDAO->atualizar(
            $id,
            $dados['usuario_id'],
            $dados['destino'],
            $dados['dias'],
            $dados['descricao']
        );
    }

    public function deletar($id) {
        return $this->roteiroDAO->deletar($id);
    }
}
?>
