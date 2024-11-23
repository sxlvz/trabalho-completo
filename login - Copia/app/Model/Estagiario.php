<?php

$estagiario = new Estagiario($banco);

class Estagiario {
    private $banco;

    public function __construct($banco) {
        $this->banco = $banco;
    }

    // Buscar estagiário por CPF ou CNPJ
    public function buscarPorCpfCnpj($login) {
        $stmt = $this->banco->prepare("SELECT * FROM estagiarios WHERE cpf_cnpj = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cadastrar um novo estagiário
    public function cadastrarEstagiario($nome, $telefone, $estagio_id, $data_inicio, $duracao, $cpf_cnpj) {
        try {
            $stmt = $this->banco->prepare("
                INSERT INTO estagiarios (nome, cpf_cnpj, telefone, estagio_id, data_inicio, duracao) 
                VALUES (:nome, :cpf_cnpj, :telefone, :estagio_id, :data_inicio, :duracao)
            ");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':estagio_id', $estagio_id, PDO::PARAM_INT); // Relacionado ao curso
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':duracao', $duracao);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar estagiário: " . $e->getMessage();
            return false;
        }
    }

    // Listar estagiários com informações do curso associado
    public function listarEstagiarios($usuarioId) {
        $stmt = $this->banco->prepare("
            SELECT 
                e.id, 
                e.nome, 
                e.cpf_cnpj, 
                e.telefone, 
                es.empresa AS curso, 
                e.data_inicio, 
                e.duracao
            FROM 
                estagiarios e
            LEFT JOIN 
                estagios es 
            ON 
                e.estagio_id = es.id
            WHERE 
                e.usuario_id = :usuario_id
        ");
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
