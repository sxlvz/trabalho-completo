<?php
require __DIR__.'/../model/Estagiobanco.php';


class ExcluirUsuario
{
    public function retornar()
    {
        (new Estagiosbanco)->excluirestagios($_GET['id']);
        require __DIR__."/../../editar-usuario.php";
       
        }
}
