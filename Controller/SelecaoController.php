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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome'  => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo' => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8')
            ];
    
            if (empty($dados['nome']) || empty($dados['grupo'])) {
                header("Location: index.php?status=erro&msg=Preencha todos os campos!");
                exit;
            }
    
            if ($this->selecoes->salvar($dados)) {
                header("Location: index.php?status=sucesso&msg=Time cadastrado com bandeira!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar");
                exit;
            }
        }
    }


    //CREATE
    public function criar(){
        require_once './Views/create.php';
    }

    public function editar($id){
        $time = $this->selecoes->buscarPorId($id);
        if ($time) {
            require_once './Views/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Aluno não encontrado");
        }
    }

    //UPDATE
    public function atualizarDados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id'     => (int)$_POST['id'],
                'nome'   => htmlspecialchars(trim($_POST['nome']), ENT_QUOTES, 'UTF-8'),
                'grupo'  => htmlspecialchars(trim($_POST['grupo']), ENT_QUOTES, 'UTF-8'),
                'titulos' => htmlspecialchars(trim($_POST['titulos']), ENT_QUOTES, 'UTF-8')
                // ← REMOVIDO criado_em
            ];
    
            if($this->selecoes->atualizarDados($dados)){
                header("Location: index.php?status=sucesso&msg=Atualizado!");
            }
        }
    }

    //DELETE
    public function deletar($id) {
        if ($this->selecoes-> deletar($id)){
            header("Location: index.php?status=sucesso&msg=Excluído!");
        }
    }


    private function buscarBandeira($nomeSelecao) {

    $paisesMap = [
        'brasil' => 'Brazil',
        'argentina' => 'Argentina', 
        'frança' => 'France',
        'alemanha' => 'Germany',
        'inglaterra' => 'England',
        'espanha' => 'Spain',
        'portugal' => 'Portugal',
        'holanda' => 'Netherlands',
        'italia' => 'Italy',
        'uruguai' => 'Uruguay',
        'mexico' => 'Mexico',
        'coreia do sul' => 'Coreia do Sul',
        'japao' => 'Japan',
        'australia' => 'Australia',
        'cuba' => 'Cuba',
        'eua' => 'EUA',
        'belgica' => 'Belgium',
        'suica' => 'Suíça',
        'siria' => 'Síria',
        'irlanda' => 'Irlanda',
        'ucrania' => 'Ucrânia'

    ];
    
    $nomeLower = strtolower(trim($nomeSelecao));
    
    // Procura correspondência exata ou parcial
    foreach ($paisesMap as $pt => $en) {
        if (strpos($nomeLower, $pt) !== false) {
            $url = "https://restcountries.com/v3.1/name/" . urlencode($en);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if ($httpCode == 200) {
                $data = json_decode($response, true);
                if (isset($data[0]['flags']['png'])) {
                    return $data[0]['flags']['png'];
                }
            }
        }
    }
    
    // Fallback: bandeira genérica de futebol
    return "https://flagcdn.com/w40/br.png"; // Brasil como padrão
    }
    public function index() {
        $pagina = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
        $limite = 6;
        
        $times = $this->selecoes->buscarPaginado($pagina, $limite);
        $total = $this->selecoes->totalRegistros();
        $totalPaginas = ceil($total / $limite);
        
        $pagina = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
        $limite = 6;
        $grupo = isset($_GET['grupo']) ? $_GET['grupo'] : '';
        
        $times = $this->selecoes->buscarComFiltro($pagina, $limite, $grupo);
        $total = $this->selecoes->contarComFiltro($grupo);
        $totalPaginas = ceil($total / $limite);
        $grupos = $this->selecoes->listarGrupos();
        
        extract([
            'times' => $times,
            'pagina' => $pagina,
            'total' => $total,
            'grupo' => $grupo,
            'grupos' => $grupos
        ]);
        
        include './Views/lista.php';
    }
}

?>