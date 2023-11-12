<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Controllers\ProductCategoryType;
use App\Models\Product;

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

            if ($nome && $categoria) {
                $db = \Config\Database::connect();
                $builder = $db->table('produto');
                $builder->where('NOME', $nome);
                $builder->where('CATEGORIA', $categoria);

                if ($builder->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('product-exists', 'Produto já cadastrado!');
                    return redirect()->back();
                }
            }

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

            try {
                $db = \Config\Database::connect();
                $builder = $db->table('produto');
                $builder->select('
                    produto.ID,
                    produto.NOME,
                    produto.PRECO,
                    produto.CATEGORIA
                ');
                //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
                $builder->orderBy('ID', 'ASC');
                $builder->limit(10); 
    
                $query = $builder->get()->getResultArray();
                $db->close();
    
                if (empty($query)) {
                    session()->setFlashdata('list-empty', 'A lista está vazia.');
                    return view('/adm/lista-produto');
                }
                $data = ['produtos' => $query];
    
                return view('/adm/lista-produto', $data);
            } catch (\Exception $e) {
                echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            }

    }

    
    public function listaUsuario()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

            try {
                $db = \Config\Database::connect();
                $builder = $db->table('usuario');
                $builder->select('
                    usuario.ID,
                    usuario.PESSOA_ID,
                    usuario.USUARIO,
                    usuario.ATIVO
                ');
                //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
                $builder->orderBy('ID', 'ASC');
                $builder->limit(10); 
    
                $query = $builder->get()->getResultArray();
                $db->close();
    
                if (empty($query)) {
                    session()->setFlashdata('list-empty', 'A lista está vazia.');
                    return view('/adm/lista-usuario');
                }
                $data = ['usuario' => $query];
    
                return view('/adm/lista-usuario', $data);
            } catch (\Exception $e) {
                echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            }
    }
    public function cadastroCategoria()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/cadastro-categoria');
    }

    public function inserirCategoria()
    {
        $myTime = Time::now('America/Sao_Paulo');
        $user = new User();

        $id = $user->idUser();
        $tipo_categoria = $this->request->getPost('categoria');
        
        $data = [
            'TIPO_CATEGORIA' => $tipo_categoria,
            'DELETED_AT' => '',
            'UPDATED_AT' => '',
            'CREATED_AT' => $myTime->toDateTimeString(),
            'ATIVO' => 1
        ];

        try {

            if ($tipo_categoria) {
                $db = \Config\Database::connect();
                $builder = $db->table('tipo_categoria_produto');
                if ($builder->where('TIPO_CATEGORIA', $tipo_categoria)->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('category-exists', 'Categoria já cadastrada!');
                    return redirect()->back();
                }
            }

            $db = \Config\Database::connect();
            $builder = $db->table('tipo_categoria_produto');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('register-category-failed', 'Tivemos um erro em salvar sua categoria, por favor tente novamente!');
            } else {
                session()->setFlashdata('register-category-success', 'categoria salvo com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function listaCategoria()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('tipo_categoria_produto');
            $builder->where('ATIVO', 1);
            $builder->select('
                tipo_categoria_produto.ID,
                tipo_categoria_produto.TIPO_CATEGORIA,

            ');
            $builder->orderBy('ID', 'ASC');
            $builder->limit(10); 

            $query = $builder->get()->getResultArray();
            $db->close();

            if (empty($query)) {
                session()->setFlashdata('list-empty', 'A lista está vazia.');
                return view('/adm/lista-categoria');
            }
            $data = ['categorias' => $query];

            return view('/adm/lista-categoria', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    // public function apresentarCategoria()
    // {
        

    // }

    public function editarCategoria($id = null)
    {
        if ($id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        $nomeCategoria = $this->getNomeCampoCategoria($id);
        $data = [
            "id_categoria" => $id,
            "nomeCategoria" => $nomeCategoria
        ];

        return view('/adm/editar-categoria', $data);
        }
    }

    public function alterarCategoria()
    {
        $myTime = Time::now('America/Sao_Paulo');
        
        $tipo_categoria = $this->request->getPost('categoria');
        $id_categoria = $this->request->getPost('idcategoria');
        
        $data = [
            'TIPO_CATEGORIA' => $tipo_categoria,
            'UPDATED_AT' => $myTime->toDateTimeString(),
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('tipo_categoria_produto');
            $builder->where('ID', $id_categoria);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('register-category-failed', 'Tivemos um erro em salvar sua categoria, por favor tente novamente!');
            } else {
                session()->setFlashdata('register-category-success', 'categoria salvo com sucesso!');
            }
            return redirect()->to('/administrador/lista-categoria');

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
        
    }

    public function getNomeCampoCategoria($id_categoria) {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_categoria_produto');
        $builder->select('TIPO_CATEGORIA');
        $builder->where('ID', $id_categoria);
        $result = $builder->get()->getRow();
    
        if ($result) {
            return $result->TIPO_CATEGORIA;
        }
    
        return null; // Retorna nulo se não encontrar a categoria
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
