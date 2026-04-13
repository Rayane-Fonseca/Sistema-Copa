<?php 
date_default_timezone_set('America/Sao_Paulo');

class Database {
    private $host = "localhost";
    private $db_name = "copa_db";
    private $user = "root";
    private $password = "alunolab";
    public $conn;
    
    public function getConnection() {
        $this -> conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão" .$e->getMessage();
        }
        return $this->conn;
    }
}

?>