<?php
require_once __DIR__ . '/../dao/RoteiroDAO.php';

class RoteiroService {
    private $roteiroDAO;

    public function __construct() {
        $this->roteiroDAO = new RoteiroDAO();
    }

    public function listar() {
        try {
            return $this->roteiroDAO->listarTodos();
        } catch (Exception $e) {
            return ["erro" => "Erro ao listar roteiros."];
        }
    }

    public function buscar($id) {
        try {
            return $this->roteiroDAO->buscarPorId($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao buscar roteiro."];
        }
    }

    public function criar($dados) {
        try {
            return $this->roteiroDAO->inserir($dados['usuario_id'], $dados['destino'], $dados['dias'], $dados['descricao']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao criar roteiro."];
        }
    }

    public function atualizar($id, $dados) {
        try {
            return $this->roteiroDAO->atualizar($id, $dados['usuario_id'], $dados['destino'], $dados['dias'], $dados['descricao']);
        } catch (Exception $e) {
            return ["erro" => "Erro ao atualizar roteiro."];
        }
    }

    public function deletar($id) {
        try {
            return $this->roteiroDAO->deletar($id);
        } catch (Exception $e) {
            return ["erro" => "Erro ao deletar roteiro."];
        }
    }
}