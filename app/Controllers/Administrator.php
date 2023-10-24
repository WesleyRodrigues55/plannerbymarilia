<?php

namespace App\Controllers;
use App\Controllers\ProductCategoryType;

class Administrator extends BaseController
{
    public function cadastroProduto()
    {
        $tipo_categoria_produto = new ProductCategoryType();

        $data = ['tipo_categoria_produto' => $tipo_categoria_produto->tipoCategoriasProdutos()];
        return
            view('/adm/cadastro-produto', $data);
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
