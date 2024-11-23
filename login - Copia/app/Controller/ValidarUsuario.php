<?php
class ValidarUsuario
{
    public function retornar()
    {
       
        if (empty($_POST['usuario'])) {
            $mensagem = '
            <div class="notification is-danger">
                <button class="delete"></button>
                Usuário vazio
            </div>';
            die($mensagem);
        }

        
        if (empty($_POST['senha'])) {
            $mensagem = '
            <div class="notification is-danger">
                <button class="delete"></button>
                Senha vazia
            </div>';
            die($mensagem);
        }

        
        $alunoExiste = (new UserBanco())->verificarSeExiste($_POST['usuario'], $_POST['senha']);

       
        if (empty($alunoExiste)) {
            die("Este usuário não existe!");
        }

        
        $mensagem = '
        <div class="notification is-success">
            <button class="delete"></button>
            Usuário logado
        </div>';
        echo $mensagem;
        if(!empty($alunoExiste)){
           require __DIR__."/../../conteudo.php";
        }
        
    }
    
}
