<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Controllers\ProductCategoryType;

class Administrator extends BaseController
{

    public function dashboard()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

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

    public function insereProduto()
    {
        $myTime = Time::now('America/Sao_Paulo');
        $user = new User();

        $id = $user->idUser();
        $tipo_categoria_produto = $this->request->getPost('tipo-categoria');
        $nome = $this->request->getPost('nome-produto');
        $preco = $this->request->getPost('preco');
        $slug = $this->request->getPost('slug');
        $tipo_capa = $this->request->getPost('tipo-da-capa');
        $categoria = $this->request->getPost('categoria');
        $descricao_elastico = $this->request->getPost('descricao-elastico');
        $encadernacao = $this->request->getPost('encardenacao');
        $tamanho_capa_sem_divisoria = $this->request->getPost('capa-sem-divisoria');
        $tamanho_capa_com_divisoria = $this->request->getPost('capa-com-divisoria');
        $tamanho_interno = $this->request->getPost('tamanho-interno');
        $quantidade_folha = $this->request->getPost('quantidade-folhas');
        $descricao_tecnica = $this->request->getPost('descricao-tecnica');
        
        $data = [
            'TIPO_CATEGORIA_PRODUTO_ID' => $tipo_categoria_produto,
            'NOME' => $nome,
            'IMAGEM' => 'produto.png',
            'PRECO' => $preco,
            'SLUG' => $slug,
            'TIPO_CAPA' => $tipo_capa,
            'CATEGORIA' => $categoria,
            'DESCRICAO_ELASTICO' => $descricao_elastico,
            'ENCADERNACAO' => $encadernacao,
            'TAMANHO_CAPA_SEM_DIVISORIA' => $tamanho_capa_sem_divisoria,
            'TAMANHO_CAPA_COM_DIVISORIA' => $tamanho_capa_com_divisoria,
            'TAMANHO_INTERNO' => $tamanho_interno,
            'QUANTIDADE_FOLHA' => $quantidade_folha,
            'DESCRICAO_TECNICA' => $descricao_tecnica,
            'DELETED_AT' => '',
            'UPDATED_AT' => '',
            'CREATED_AT' => $myTime->toDateTimeString(),
            'ATIVO' => 1
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('register-produtc-failed', 'Tivemos um erro em salvar seu produto, por favor tente novamente!');
            } else {
                session()->setFlashdata('register-product-success', 'produto salvo com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function listaProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/lista-produto');
    }
    public function listaUsuario()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/lista-usuario');
    }
    public function cadastroCategoria()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/cadastro-categoria');
    }
    public function listaCategoria()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/lista-categoria');
    }
    public function editarCategoria()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/editar-categoria');
    }
    public function editarProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/editar-produto');
    }
}
