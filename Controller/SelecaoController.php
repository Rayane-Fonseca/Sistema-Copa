<?php 
require_once './Model/Selecao.php';
require_once './config/Database.php';

class SelecaoController {
    private $db;
    private $selecoes;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->selecoes = new Selecao($this->db);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo' => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8')
            ];

            if (empty($dados['nome']) || empty($dados['grupo'])) {
                header("Location: index.php?action=novo&status=erro&msg=" . urlencode("Preencha todos os campos!"));
                exit;
            }

            if ($this->selecoes->existeNome($dados['nome'])) {
                header("Location: index.php?action=novo&status=erro&msg=" . urlencode("País já cadastrado!"));
                exit;
            }

            $dados['bandeira'] = $this->buscarBandeira($dados['nome']);

            if ($this->selecoes->salvar($dados)) {
                header("Location: index.php?status=sucesso&msg=" . urlencode("Time cadastrado com bandeira!"));
                exit;
            } else {
                header("Location: index.php?action=novo&status=erro&msg=" . urlencode("Erro ao salvar"));
                exit;
            }
        }
    }

    private function buscarBandeira($nomeSelecao) {
        $paisesMap = [
            'brasil' => 'https://flagcdn.com/w40/br.png',
            'argentina' => 'https://flagcdn.com/w40/ar.png',
            'frança' => 'https://flagcdn.com/w40/fr.png',
            'franca' => 'https://flagcdn.com/w40/fr.png',
            'alemanha' => 'https://flagcdn.com/w40/de.png',
            'inglaterra' => 'https://flagcdn.com/w40/gb.png',
            'espanha' => 'https://flagcdn.com/w40/es.png',
            'portugal' => 'https://flagcdn.com/w40/pt.png',
            'holanda' => 'https://flagcdn.com/w40/nl.png',
            'italia' => 'https://flagcdn.com/w40/it.png',
            'uruguai' => 'https://flagcdn.com/w40/uy.png',
            'mexico' => 'https://flagcdn.com/w40/mx.png',
            'coreia do sul' => 'https://flagcdn.com/w40/kr.png',
            'japao' => 'https://flagcdn.com/w40/jp.png',
            'australia' => 'https://flagcdn.com/w40/au.png',
            'cuba' => 'https://flagcdn.com/w40/cu.png',
            'eua' => 'https://flagcdn.com/w40/us.png',
            'estados unidos' => 'https://flagcdn.com/w40/us.png',
            'belgica' => 'https://flagcdn.com/w40/be.png',
            'suica' => 'https://flagcdn.com/w40/ch.png',
            'siria' => 'https://flagcdn.com/w40/sy.png',
            'irlanda' => 'https://flagcdn.com/w40/ie.png',
            'ucrania' => 'https://flagcdn.com/w40/ua.png'
        ];

        $nomeLower = mb_strtolower(trim($nomeSelecao), 'UTF-8');

        foreach ($paisesMap as $pais => $url) {
            if (strpos($nomeLower, $pais) !== false) {
                return $url;
            }
        }

        return 'https://flagcdn.com/w40/br.png';
    }

    public function criar() {
        require_once './Views/create.php';
    }

    public function editar($id) {
        $time = $this->selecoes->buscarPorId($id);
        if ($time) {
            require_once './Views/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada");
            exit;
        }
    }

    public function atualizarDados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id' => (int)$_POST['id'],
                'nome' => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo' => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8')
            ];

            if ($this->selecoes->atualizarDados($dados)) {
                header("Location: index.php?status=sucesso&msg=Atualizado!");
                exit;
            }

            header("Location: index.php?status=erro&msg=Erro ao atualizar!");
            exit;
        }
    }

    public function deletar($id) {
        if ($this->selecoes->deletar($id)) {
            header("Location: index.php?status=sucesso&msg=Excluído!");
            exit;
        }
    }

    public function index() {
        $pagina = isset($_GET['p']) ? max(1, (int) $_GET['p']) : 1;
        $limite = 6;
        $grupo = isset($_GET['grupo']) ? trim($_GET['grupo']) : '';

        $times = $this->selecoes->buscarComFiltro($pagina, $limite, $grupo);
        $total = $this->selecoes->contarComFiltro($grupo);
        $totalPaginas = ceil($total / $limite);
        $grupos = $this->selecoes->listarGrupos();

        $pagina = isset($_GET['p']) ? max(1, (int) $_GET['p']) : 1;
        $limite = 6;
        $grupo = isset($_GET['grupo']) ? trim($_GET['grupo']) : '';
    
        $times = $this->selecoes->buscarComFiltro($pagina, $limite, $grupo);
        $total = $this->selecoes->contarComFiltro($grupo);
        $totalPaginas = ceil($total / $limite);
        $grupos = $this->selecoes->listarGrupos();
    
        $dashboardTotalSelecoes = $this->selecoes->totalSelecoes();
        $dashboardTotalTitulos = $this->selecoes->totalTitulos();
        $dashboardPorGrupo = $this->selecoes->selecoesPorGrupo();
    
        require './Views/lista.php';
    }

    public function dashboard() {
        $dashboardTotalSelecoes = $this->selecoes->totalSelecoes();
        $dashboardTotalTitulos = $this->selecoes->totalTitulos();
        $dashboardPorGrupo = $this->selecoes->selecoesPorGrupo();
    
        require_once './Views/dashboard.php';
    }
}

?>