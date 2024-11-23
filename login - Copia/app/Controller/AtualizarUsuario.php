<?php

use UserBanco;

class AtualizarUsuario{
    public function retornar(){
      $usuario = (new UserBanco())->atualizarUsuario($_POST['usuario'],$_POST['senha'],$_POST['ativo']);
      if($usuario){
        return "Usuario atualizado! 😍";
      };
      return "Usuario não atulizado! 😒";
    }
}