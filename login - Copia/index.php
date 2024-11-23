<?php
ob_start(); 
session_start(); 
require __DIR__ . "/app/model/Userbanco.php";
require __DIR__ . "/app/Controller/ValidarUsuario.php";
require __DIR__ . "/app/Controller/CadastrarUsuario.php";
require __DIR__ . "/app/Controller/ExcluirUsuario.php";
require __DIR__ . "/header.php";


$acao = $_GET['acao'] ?? null;

if (!$acao) {
    
    header("Location: ./inicio.php");
    exit;
}


if (($acao === 'login' || $acao === 'cadastra') && (!isset($_POST['usuario']) || !isset($_POST['senha']))) {
    header("Location: ./inicio.php");
    exit;
}


if ($acao === 'login' || $acao === 'cadastra') {
    if ($_POST['usuario'] == "") {
        echo '
            <div class="notification is-danger">
                <button class="delete"></button>
                Usuário vazio
            </div>';
        exit;
    }

    if ($_POST['senha'] == "") {
        echo '
            <div class="notification is-danger">
                <button class="delete"></button>
                Senha vazia
            </div>';
        exit;
    }
}


switch ($acao) {
    case 'login':
        $validarUsuario = new ValidarUsuario();
        $usuarioId = $validarUsuario->retornar($_POST['usuario'], $_POST['senha']);

        if ($usuarioId) {
           
            $_SESSION['usuario_Id'] = $usuarioId;
            
            header("Location: listar_estagios.php");
            exit();
        } else {
          
            exit();
        }
        break;

    case 'cadastra':
        $cadastrarUsuario = new CadastrarUsuario();
        $cadastrarUsuario->retornar();
        break;

    case 'excluir':
        $excluirUsuario = new ExcluirUsuario();
        $excluirUsuario->retornar();
        header("Location: listar_estagios.php");
        break;

    default:
      
        header("Location: ./inicio.php");
        exit;
}

ob_end_flush(); // Envia o buffer de saída e encerra o buffering
?>
