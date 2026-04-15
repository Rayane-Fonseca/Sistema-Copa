<?php
class Selecao {
    private $conn;
    private $table = "selecoes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function salvar($dados) {
        $criado_em = date('Y-m-d H:i:s');
        $bandeira = $this->getBandeiraByNome($dados['nome']);

        $query = "INSERT INTO " . $this->table . "
                  (nome, grupo, titulos, criado_em, bandeira)
                  VALUES (:nome, :grupo, :titulos, :criado_em, :bandeira)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        $stmt->bindParam(':criado_em', $criado_em);
        $stmt->bindParam(':bandeira', $bandeira);

        return $stmt->execute();
    }

    private function getBandeiraByNome($nome) {
        $nomeLower = strtolower(trim($nome));

        $bandeiras = [
            'brasil' => 'https://flagcdn.com/w40/br.png',
            'argentina' => 'https://flagcdn.com/w40/ar.png',
            'alemanha' => 'https://flagcdn.com/w40/de.png',
            'franca' => 'https://flagcdn.com/w40/fr.png',
            'espanha' => 'https://flagcdn.com/w40/es.png',
            'inglaterra' => 'https://flagcdn.com/w40/gb-eng.png',
            'portugal' => 'https://flagcdn.com/w40/pt.png',
            'italia' => 'https://flagcdn.com/w40/it.png',
            'holanda' => 'https://flagcdn.com/w40/nl.png',
            'uruguai' => 'https://flagcdn.com/w40/uy.png',
            'ucrania' => 'https://flagcdn.com/w40/ua.png',
            'cuba' => 'https://flagcdn.com/w40/cu.png',
            'eua' => 'https://flagcdn.com/w40/us.png',
            'belgica' => 'https://flagcdn.com/w40/be.png',
            'suica' => 'https://flagcdn.com/w40/ch.png',
            'siria' => 'https://flagcdn.com/w40/sy.png',
            'irlanda' => 'https://flagcdn.com/w40/ie.png',
            'mexico' => 'https://flagcdn.com/w40/mx.png',
            'coreia do sul' => 'https://flagcdn.com/w40/kr.png',
            'japao' => 'https://flagcdn.com/w40/jp.png',
            'australia' => 'https://flagcdn.com/w40/au.png'
        ];

        foreach ($bandeiras as $chave => $url) {
            if (strpos($nomeLower, $chave) !== false) {
                return $url;
            }
        }

        return 'https://flagcdn.com/w40/br.png';
    }

    public function existeNome($nome) {
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE LOWER(nome) = LOWER(:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function atualizarDados($dados) {
        $bandeira = $this->getBandeiraByNome($dados['nome']);
    
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome, grupo = :grupo, titulos = :titulos, bandeira = :bandeira
                  WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':grupo', $dados['grupo']);
        $stmt->bindParam(':titulos', $dados['titulos']);
        $stmt->bindParam(':bandeira', $bandeira);
        $stmt->bindParam(':id', $dados['id']);
    
        return $stmt->execute();
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function buscarComFiltro($pagina = 1, $limite = 6, $grupo = null) {
        $offset = ($pagina - 1) * $limite;
        $where = '';
        $params = [];

        if ($grupo && $grupo != 'todos') {
            $where = "WHERE grupo = :grupo";
            $params[':grupo'] = $grupo;
        }

        $query = "SELECT * FROM {$this->table} $where ORDER BY nome ASC LIMIT :limite OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarComFiltro($grupo = null) {
        $where = '';
        $params = [];

        if ($grupo && $grupo != 'todos') {
            $where = "WHERE grupo = :grupo";
            $params[':grupo'] = $grupo;
        }

        $query = "SELECT COUNT(*) FROM {$this->table} $where";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function listarGrupos() {
        $query = "SELECT DISTINCT grupo FROM {$this->table} ORDER BY grupo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function totalSelecoes() {
        $sql = "SELECT COUNT(*) as total FROM selecoes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function totalTitulos() {
        $sql = "SELECT SUM(titulos) as total FROM selecoes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function selecoesPorGrupo() {
        $sql = "SELECT grupo, COUNT(*) as total FROM selecoes GROUP BY grupo ORDER BY grupo";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodas() {
        $query = "SELECT * FROM selecoes ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>