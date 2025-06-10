<?php
require_once _DIR_ . '/../dao/AtividadeDAO.php';

class AtividadeService {
    private $atividadeDAO;

    public function __construct() {
        $this->atividadeDAO = new AtividadeDAO();
    }

    public function listarPorRoteiro($roteiroId) {
        try {
            return $this->atividadeDAO->listarPorRoteiro($roteiroId);
        } catch (Exception $e) {
            return ["erro" => "Erro ao listar atividades."];
        }
    }

    public function criar($dados) {
        try {
            return $this->atividadeDAO->inserir($dados['roteiro_id'], $dados['nome'], $dados['horario'], $dados['descricao']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao criar atividade."];
        }
    }

    public function deletar($id) {
        try {
            return $this->atividadeDAO->deletar($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao deletar atividade."];
        }
    }
}
