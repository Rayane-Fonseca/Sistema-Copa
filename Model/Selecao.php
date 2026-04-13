<?php 

    class Selecao{
        private $conn;
        private $table = "selecoes"; 

        public function __construct($db){
            $this ->conn = $db; 
        }

        //READ
        public function buscarTodos(){
            $query = "SELECT * FROM " . $this->table. " ORDER BY id DESC LIMIT 6"; 
            $stmt = $this->conn->prepare($query); 
            $stmt->execute(); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //CREATE

        public function salvar($dados){
            $criado_em = date('Y-m-d H:i:s');
            
            // Busca simples de bandeira - SEM CURL (mais confiável)
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
            
            return null;
        }

        //UPDATE
        public function atualizarDados($dados){
            $query = "UPDATE " . $this->table . "
                SET nome = :nome, grupo = :grupo, titulos = :titulos
                WHERE id = :id"; 
        
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':grupo', $dados['grupo']);
            $stmt->bindParam(':titulos', $dados['titulos']);
            $stmt->bindParam(':id', $dados['id']);
            
            return $stmt->execute();
        }

        public function buscarPorId($id) {
            $query = "SELECT * FROM " .$this->table . " WHERE id= ? LIMIT 0,1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt-> execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        //DELETE
        public function deletar($id) {
            $query = "DELETE FROM " . $this->table . " WHERE id= ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            return $stmt->execute();
        }

        private function buscarBandeira($nomeSelecao) {
            // Mesmo código do controller acima
            $paisesMap = [
                'brasil' => 'Brazil', 'argentina' => 'Argentina', 
                'frança' => 'France', 'alemanha' => 'Germany',
                'inglaterra' => 'England', 'espanha' => 'Spain'
                // ... resto dos países
            ];
            
            $nomeLower = strtolower(trim($nomeSelecao));
            foreach ($paisesMap as $pt => $en) {
                if (strpos($nomeLower, $pt) !== false) {
                    $url = "https://restcountries.com/v3.1/name/" . urlencode($en);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
                    $response = curl_exec($ch);
                    
                    $data = json_decode($response, true);
                    if (isset($data[0]['flags']['png'])) {
                        return $data[0]['flags']['png'];
                    }
                }
            }
            return null; // Sem bandeira
        }
        public function buscarPaginado($pagina = 1, $limite = 6) {
            $offset = ($pagina - 1) * $limite;
            $query = "SELECT * FROM {$this->table} ORDER BY nome ASC LIMIT :limite OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function totalRegistros() {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchColumn();
        }
        
        public function buscarComFiltro($pagina = 1, $limite = 6, $grupo = null) {
            $offset = ($pagina - 1) * $limite;
            $where = '';
            $params = [];
            
            // Filtro por grupo
            if ($grupo && $grupo != 'todos') {
                $where = "WHERE grupo = :grupo";
                $params[':grupo'] = $grupo;
            }
            
            $query = "SELECT * FROM {$this->table} $where 
                      ORDER BY nome ASC 
                      LIMIT :limite OFFSET :offset";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            
            // Bind filtro se existir
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
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
            
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
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
 }
?>