<?php


require_once __DIR__ . '/../Database/Conectar.php'; // Conectar ao banco de dados
require_once __DIR__ . '/../Model/Estagiario.php';  // Incluir o model Estagiario

class EstagiarioController {

    private $pdo;
    private $estagiarioModel;

    public function __construct() {
        // Conexão com o banco de dados
        $this->pdo = new PDO("sqlite:" . __DIR__ . '/../../banco.db');
        $this->estagiarioModel = new Estagiario($this->pdo);
    }

  
    public function listar() {
        
        $estagiarios = $this->estagiarioModel->listarEstagiarios();

       
        $message = $_GET['message'] ?? null;

        
        include 'app/View/Estagiarios/listar_estagiarios.php';
    }

  
    public function excluir($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM estagiarios WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                header("Location: listar_estagiarios.php?message=excluido");
                exit;
            } else {
                throw new Exception("Erro ao excluir o estagiário.");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
