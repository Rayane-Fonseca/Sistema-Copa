<?php
require_once './Model/Jogador.php';
require_once './Model/Selecao.php';
require_once './config/Database.php';

class JogadorController {
    private $db;
    private $jogador;
    private $selecao;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->jogador = new Jogador($this->db);
        $this->selecao = new Selecao($this->db);
    }

    public function criar($selecao_id = null) {
        $selecoes = $this->selecao->listarTodas();
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

            if ($this->jogador->salvar($dados)) {
                header("Location: index.php?action=elenco&selecao_id=" . $dados['selecao_id'] . "&status=sucesso&msg=Jogador cadastrado!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar jogador!");
                exit;
            }
        }
    }

    public function elenco($selecao_id) {
        $selecao = $this->selecao->buscarPorId($selecao_id);
        $jogadores = $this->jogador->buscarPorSelecao($selecao_id);

        if ($selecao) {
            require_once './Views/elenco.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada!");
            exit;
        }
    }

    public function editar($id) {
        $jogador = $this->jogador->buscarPorId($id);
        $selecoes = $this->selecao->listarTodas();

        if ($jogador) {
            require_once './Views/jogador-edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Jogador não encontrado!");
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

            if ($this->jogador->atualizar($dados)) {
                header("Location: index.php?action=elenco&selecao_id=" . $dados['selecao_id'] . "&status=sucesso&msg=Jogador atualizado!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao atualizar jogador!");
                exit;
            }
        }
    }

    public function deletar($id, $selecao_id) {
        if ($this->jogador->deletar($id)) {
            header("Location: index.php?action=elenco&selecao_id=" . $selecao_id . "&status=sucesso&msg=Jogador excluído!");
            exit;
        }
    }
}
?>