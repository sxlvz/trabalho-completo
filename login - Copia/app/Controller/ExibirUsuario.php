<?php
require __DIR__ . "/../Model/UserBanco.php";
use UserBanco;

class ExibirUsuario {
    public function retornar() {
        $usuarios = (new UserBanco())->listarUsuario();
        require __DIR__ . "/../../exibir-dados.php";
    }
}
