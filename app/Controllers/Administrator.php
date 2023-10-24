<?php

namespace App\Controllers;

class Administrator extends BaseController
{
    public function cadastroProduto()
    {
        return
            view('/adm/cadastro-produto');
    }

    public function listaProduto()
    {
        return
            view('/adm/lista-produto');
    }
    public function listaUsuario()
    {
        return
            view('/adm/lista-usuario');
    }
}
