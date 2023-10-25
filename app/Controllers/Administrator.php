<?php

namespace App\Controllers;

use App\Controllers\ProductCategoryType;

class Administrator extends BaseController
{

    public function dashboard()
    {
        return
            view('/adm/index');
    }
    public function cadastroProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
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
    public function cadastroCategoria()
    {
        return
            view('/adm/cadastro-categoria');
    }
    public function listaCategoria()
    {
        return
            view('/adm/lista-categoria');
    }
    public function editarCategoria()
    {
        return
            view('/adm/editar-categoria');
    }
    public function editarProduto()
    {
        return
            view('/adm/editar-produto');
    }
}
