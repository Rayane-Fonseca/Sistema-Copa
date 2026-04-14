<?php
class Jogador {
    private $conn;
    private $table = "jogadores";

    public $id;
    public $nome;
    public $posicao;
    public $numero_camisa;
    public $selecao_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function salvar($dados) {
        $query = "INSERT INTO " . $this->table . "
                  (nome, posicao, numero_camisa, selecao_id)
                  VALUES (:nome, :posicao, :numero_camisa, :selecao_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':posicao', $dados['posicao']);
        $stmt->bindParam(':numero_camisa', $dados['numero_camisa']);
        $stmt->bindParam(':selecao_id', $dados['selecao_id']);

        return $stmt->execute();
    }

    public function buscarPorSelecao($selecao_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE selecao_id = :selecao_id ORDER BY numero_camisa ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':selecao_id', $selecao_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($dados) {
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome,
                      posicao = :posicao,
                      numero_camisa = :numero_camisa,
                      selecao_id = :selecao_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $dados['id']);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':posicao', $dados['posicao']);
        $stmt->bindParam(':numero_camisa', $dados['numero_camisa']);
        $stmt->bindParam(':selecao_id', $dados['selecao_id']);

        return $stmt->execute();
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>