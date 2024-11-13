<?php
require_once __DIR__ . "/../Model/UserBanco.php";

class CadastrarUsuario {
    public function retornar() {
        $userBanco = new UserBanco();

       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        try {
            
            $userBanco->cadastrarUsuario($_POST['usuario'], $_POST['senha'], true);
            
            $_SESSION['mensagem_sucesso'] = "Usuário cadastrado com sucesso!";
       
            header("Location: registro.php");
            exit();
        } catch (Exception $e) {
           
            $_SESSION['mensagem_erro'] = "Erro: " . $e->getMessage();
            return false; 
        }
    }
}
?>
