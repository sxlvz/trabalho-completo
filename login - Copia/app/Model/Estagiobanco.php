<?php
require_once __DIR__ . "/Estagio.php"; 

class Estagiosbanco {
    private $pdo;

    public function __construct() {
        // Inicializa a conexão com o banco
        require_once __DIR__ . "/../Database/Conectar.php";
        $this->pdo = $banco ?? new PDO("sqlite:banco.db");
    }

    
    function iniciarSessao() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function cadastrarestagios($empresa, $funcionario, $data, $dataTermino, $horario, $usuarioId) {
        try {
            $sql = "INSERT INTO estagios (empresa, funcionario, data, data_termino, horario, usuario_id)
                    VALUES (:empresa, :funcionario, :data, :data_termino, :horario, :usuario_id)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':funcionario', $funcionario);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':data_termino', $dataTermino);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);

            $stmt->execute();
            return $this->pdo->lastInsertId(); 

        } catch (PDOException $e) {
            echo "<p class='notification is-danger'>Erro ao cadastrar estágio: " . $e->getMessage() . "</p>";
            return false;
        }
    }

    public function editarestagios($empresa, $funcionario, $data, $horario, $id) {
        $sql = "UPDATE estagios SET empresa = :empresa, funcionario = :funcionario, data = :data, horario = :horario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":empresa", $empresa);
        $stmt->bindValue(":funcionario", $funcionario);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":horario", $horario);
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

  
    public function buscarestagiosPorId($id) {
        $sql = "SELECT * FROM estagios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hidratar($resultado);
    }

    
    public function atualizarestagios($empresa, $funcionario, $data, $horario, $id) {
        $sql = "UPDATE estagios SET empresa = :empresa, funcionario = :funcionario, data = :data, horario = :horario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":empresa", $empresa);
        $stmt->bindValue(":funcionario", $funcionario);
        $stmt->bindValue(":data", $data);
        $stmt->bindValue(":horario", $horario);
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

  
    public function excluirestagios($id) {
        $sql = "DELETE FROM estagios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);

        return $stmt->execute();
    }

    

    public function listarestagios($usuarioId) {
        try {
            $sql = "SELECT e.empresa, e.funcionario, e.data, e.horario, e.id
                    FROM estagios e
                    INNER JOIN user_est ue ON e.id = ue.estagio_id
                    WHERE ue.usuario_id = :usuario_id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<p class='notification is-danger'>Erro ao buscar estágios: " . $e->getMessage() . "</p>";
            return [];
        }
    }


    public function hidratar($array) {
        $todos = [];
    
        foreach ($array as $dado) {
            $objeto = new Estagio();
            $objeto->setempresa($dado['empresa']);
            $objeto->setfuncionario($dado['funcionario']);
            $objeto->setdata($dado['data']);
            $objeto->sethorario($dado['horario']);
            $objeto->setId($dado['id']);
            
            // Calcula a duração se data_termino estiver disponível
            if (isset($dado['data']) && isset($dado['data_termino'])) {
                $dataInicio = new DateTime($dado['data']);
                $dataTermino = new DateTime($dado['data_termino']);
                $duracaoDias = $dataInicio->diff($dataTermino)->days;
                $objeto->setduracao($duracaoDias);
            } else {
                $objeto->setduracao(0); // Define 0 dias se não houver data de término
            }
    
            $todos[] = $objeto;
        }
    
        return $todos;
    }
}
