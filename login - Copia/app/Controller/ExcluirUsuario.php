<?php
require __DIR__."/../Model/Estagiobanco.php";

class ExcluirUsuario{
    public function retornar(){
      $usuarios = (new UserBanco())->excluirUsuario($_GET['id']);       

    }
}