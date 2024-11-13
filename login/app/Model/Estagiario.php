<?php
$pdo = new PDO("sqlite:/../../banco.db");  
$estagiario = new Estagiario($pdo);  

class Estagiario {
    private $banco;

    public function __construct($banco) {
        $this->banco = $banco;
    }

    
    public function buscarPorCpfCnpj($login) {
        $stmt = $this->banco->prepare("SELECT * FROM estagiarios WHERE cpf_cnpj = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrarEstagiario($nome, $telefone, $curso, $data_inicio, $duracao, $cpf_cnpj) {
        try {
            $stmt = $this->banco->prepare("INSERT INTO estagiarios (nome, cpf_cnpj, telefone, curso, data_inicio, duracao) 
                                           VALUES (:nome, :cpf_cnpj, :telefone, :curso, :data_inicio, :duracao)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':duracao', $duracao);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
           
            echo "Erro ao cadastrar estagiário: " . $e->getMessage();
            return false;
        }
    }

public function listarEstagiarios() {
    $stmt = $this->banco->query("SELECT * FROM estagiarios");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
}
?>
