<?php
// app/Controller/EstagiarioController.php

require_once 'app/Database/Conectar.php'; // Conectar ao banco de dados
require_once 'app/Model/Estagiario.php';  // Incluir o modelo Estagiario

class EstagiarioController {

    private $pdo;
    private $estagiarioModel;

    public function __construct() {
        // Conexão com o banco de dados
        $this->pdo = new PDO("sqlite:" . __DIR__ . '/../../banco.db');
        $this->estagiarioModel = new Estagiario($this->pdo);
    }

    // Método para listar estagiários
    public function listar() {
        // Obter os estagiários
        $estagiarios = $this->estagiarioModel->listarEstagiarios();

        // Verifica se existe uma mensagem de confirmação na URL
        $message = $_GET['message'] ?? null;

        // Chama a visualização para listar os estagiários
        include 'app/View/Estagiarios/listar_estagiarios.php';
    }

    // Método para excluir um estagiário
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
