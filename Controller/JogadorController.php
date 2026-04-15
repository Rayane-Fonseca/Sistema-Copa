<?php

require_once './Model/Jogador.php';
require_once './Model/Selecao.php';
require_once './config/Database.php';

class JogadorController {
    private $db;
    private $jogadores;
    private $selecoes;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->jogadores = new Jogador($this->db);
        $this->selecoes = new Selecao($this->db);
    }

    public function criar($selecao_id = null) {
        $selecao = null;

        if ($selecao_id) {
            $selecao = $this->selecoes->buscarPorId($selecao_id);
        }

        $todasSelecoes = $this->selecoes->buscarTodas();
        require_once './Views/jogador-create.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'posicao' => htmlspecialchars(trim($_POST['posicao']), ENT_QUOTES, 'UTF-8'),
                'numero_camisa' => (int) $_POST['numero_camisa'],
                'selecao_id' => (int) $_POST['selecao_id']
            ];

            if (empty($dados['nome']) || empty($dados['posicao']) || empty($dados['numero_camisa']) || empty($dados['selecao_id'])) {
                header("Location: index.php?status=erro&msg=Preencha todos os campos!");
                exit;
            }

            if ($this->jogadores->salvar($dados)) {
                header("Location: index.php?action=elenco&selecao_id=" . $dados['selecao_id'] . "&status=sucesso&msg=Jogador cadastrado!");
                exit;
            }

            header("Location: index.php?status=erro&msg=Erro ao salvar jogador");
            exit;
        }
        
    }
    

    public function editar($id) {
        $jogador = $this->jogadores->buscarPorId($id);
        $todasSelecoes = $this->selecoes->buscarTodas();

        if ($jogador) {
            require_once './Views/jogador-edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Jogador não encontrado");
            exit;
        }
    }

    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id' => (int) $_POST['id'],
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'posicao' => htmlspecialchars(trim($_POST['posicao']), ENT_QUOTES, 'UTF-8'),
                'numero_camisa' => (int) $_POST['numero_camisa'],
                'selecao_id' => (int) $_POST['selecao_id']
            ];

            if ($this->jogadores->atualizar($dados)) {
                header("Location: index.php?action=elenco&selecao_id=" . $dados['selecao_id'] . "&status=sucesso&msg=Jogador atualizado!");
                exit;
            }

            header("Location: index.php?status=erro&msg=Erro ao atualizar jogador");
            exit;
        }
    }

    public function deletar($id, $selecao_id = null) {
        $jogador = $this->jogadores->buscarPorId($id);

        if ($jogador && $this->jogadores->deletar($id)) {
            $redirectId = $selecao_id ?: $jogador['selecao_id'];
            header("Location: index.php?action=elenco&selecao_id=" . $redirectId . "&status=sucesso&msg=Jogador excluído!");
            exit;
        }

        header("Location: index.php?status=erro&msg=Erro ao excluir jogador");
        exit;
    }

    public function elenco($selecao_id) {
        $selecao = $this->selecoes->buscarPorId($selecao_id);
        $jogadores = $this->jogadores->buscarPorSelecao($selecao_id);

        if ($selecao) {
            require_once './Views/elenco.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada");
            exit;
        }
    }
}
?>