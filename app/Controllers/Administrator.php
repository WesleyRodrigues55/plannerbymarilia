<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Controllers\ProductCategoryType;
use App\Controllers\Product;
use App\Controllers\User;
use CodeIgniter\Files\File;

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

    public function cadastroCapasProduto($id_produto)
    {
        if (!$id_produto)
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $tipo_categoria_produto = new ProductCategoryType();

        $data = ['id_produto' => $id_produto ];
        return
            view('/adm/cadastro-capas-produto', $data);
    }

    public function uploadImagemCapasProduto($imagens)
    {
        $nomesDosArquivos = [];

        $rules = [
            'foto-produto' => 'uploaded[foto-produto]|mime_in[foto-produto,image/png,image/jpeg]|max_size[foto-produto,1024]' // 1 MB máximo
        ];
        if ($this->validate($rules))
        {
            foreach ($imagens as $img) {
                if ($img->isValid() && !$img->hasMoved())
                {
                    $novoNome = uniqid() . '_' . $img->getName();
                    $img->move(ROOTPATH . 'public/assets/img/produtos/capas-internas', $novoNome);
                    $nomesDosArquivos[] = $novoNome;
                }
                else
                {
                    $nomesDosArquivos[] = $img->getErrorString();
                    return false;
                }
            }
        }
        else
        {
            $nomesDosArquivos[] = implode('<br>', $this->validator->getErrors());
            return false;
        }
        return $nomesDosArquivos;
    }


    public function insereCapasProduto() {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $id_produto = $this->request->getPost('id-produto');
        $imagens = $this->request->getFileMultiple('foto-produto');
        $nomesDosArquivos = $this->uploadImagemCapasProduto($imagens);
        if (!$nomesDosArquivos) {
            session()->setFlashdata('imagem-invalida', 'Imagens e capas não são validas, tenten novamente!');
            return redirect()->back();
        } 
        foreach ($nomesDosArquivos as $nomeDoArquivo) {
            $data = [
                'PRODUTO_ID' => $id_produto,
                'IMAGEM_CAPA' => $nomeDoArquivo,
                'ATIVO' => 1
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('capas_produtos');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('erro-insert-capas', 'Ocorreu um erro no cadastro das capas, tente novamente!');
            } else {
                session()->setFlashdata('succes-insert-capas', 'Capas cadastradas com sucesso!');
            }
        }
        return redirect()->back();
    }

    public function listaCapasProduto($id_produto)
    {
        if (!$id_produto)
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('capas_produtos');
            $builder->where('ATIVO', 1);
            $builder->orderBy('ID', 'ASC');
            $builder->limit(10); 

            $query = $builder->get()->getResultArray();
            $db->close();

            if (empty($query)) {
                $data = ['id_produto' => $id_produto];
                session()->setFlashdata('list-empty', 'A lista está vazia.');
                return view('/adm/lista-capas-produto', $data);
            }
            $data = ['capas' => $query];

            return view('/adm/lista-capas-produto', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function editarCapaProduto($id)
    {
        if ($id == null)
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $db = \Config\Database::connect();
        $builder = $db->table('capas_produtos');
        $builder->where("ID", $id);
        $query = $builder->get()->getResultArray();
        $db->close();
        
        $data = [
            "capa_produto" => $query, 
        ];
        return view('/adm/editar-capa-produto', $data);
    }

    public function uploadImagemCapaProduto($img) {
        $rules = [
            'foto-capa-produto' => 'uploaded[foto-capa-produto]|mime_in[foto-capa-produto,image/png,image/jpeg]|max_size[foto-capa-produto,1024]' // 1 MB máximo
        ];

        if ($this->validate($rules))
        {
            if ($img->isValid() && !$img->hasMoved())
            {
                $novoNome = uniqid() . '_' . $img->getName();
                $img->move(ROOTPATH . 'public/assets/img/produtos/capas-internas/', $novoNome);
                return $novoNome;
            }
            else
            {
                return false;
                return $img->getErrorString();
            }
        }
        else {
            return false;
            return implode('<br>', $this->validator->getErrors());
        }
    }

    public function alterarCapaProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        $id = $this->request->getPost('id');
        $id_produto = $this->request->getPost('id-produto');
        $nova_imagem = $this->request->getFile('foto-capa-produto');

        $move_img = $this->uploadImagemCapaProduto($nova_imagem);
        if (!$move_img) {
            session()->setFlashdata('imagem-invalida', 'Imagem não é valida!');
            return redirect()->back();
        } 
        
        $data = [
            'IMAGEM_CAPA' => $move_img
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('capas_produtos');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('register-capa-failed', 'Tivemos um erro em editar a capa do produto, por favor tente novamente!');
            } else {
                session()->setFlashdata('register-capa-success', 'Capa do produto editado com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function desativarCapaProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $id = $this->request->getPost('id-capa-produto');
        $id_produto = $this->request->getPost('id-produto');
        $data = [
            'ATIVO' => 0,
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('capas_produtos');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.',
                    'id_produto' => $id_produto
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.',
                    'id_produto' => $id_produto
                );

            }
            echo json_encode($response);

            // return redirect()->back();

        } catch (\Exception $e) {
            log_message('error', 'Erro na conexão com o banco de dados: ' . $e->getMessage());
            // Lidar com o erro de forma adequada, exibir uma mensagem de erro amigável ao usuário, etc.
        }
    }

    public function uploadImagemProduto($img) {
        $rules = [
            'foto-produto' => 'uploaded[foto-produto]|mime_in[foto-produto,image/png,image/jpeg]|max_size[foto-produto,1024]' // 1 MB máximo
        ];

        if ($this->validate($rules))
        {
            if ($img->isValid() && !$img->hasMoved())
            {
                $novoNome = uniqid() . '_' . $img->getName();
                $img->move(ROOTPATH . 'public/assets/img/produtos/capas-externas', $novoNome);
                return $novoNome;
            }
            else
            {
                return false;
                return $img->getErrorString();
            }
        }
        else {
            return false;
            return implode('<br>', $this->validator->getErrors());
        }
    }

    public function cadastrarQuantidadeEstoquePeloIdProduto($id_produto, $quantidade_estoque) {
        $data = [
            'PRODUTO_ID' => $id_produto,
            'QUANTIDADE' => $quantidade_estoque,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('estoque');
        $builder->insert($data);
        $db->close();
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
        $quantidade_estoque = $this->request->getPost('quantidade');

        $img = $this->request->getFile('foto-produto');

        $move_img = $this->uploadImagemProduto($img);
        if (!$move_img) {
            session()->setFlashdata('imagem-invalida', 'Imagem não é valida!');
            return redirect()->back();
        } 
    
        $data = [
            'TIPO_CATEGORIA_PRODUTO_ID' => $tipo_categoria_produto,
            'NOME' => $nome,
            'IMAGEM' => $move_img,
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
            $ultimo_id_produto_inserido = $db->insertID();
            $db->close();

            $this->cadastrarQuantidadeEstoquePeloIdProduto($ultimo_id_produto_inserido, $quantidade_estoque);

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
                $builder->where('ATIVO', 1);
                $builder->select('
                    produto.ID,
                    produto.NOME,
                    produto.PRECO,
                    produto.CATEGORIA
                ');
                //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
                $builder->orderBy('ID', 'DESC');
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
                $builder->where('ATIVO', 1);
                $builder->select('
                    usuario.ID,
                    usuario.PESSOA_ID,
                    usuario.USUARIO,
                    usuario.ATIVO
                ');
                //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
                $builder->orderBy('ID', 'DESC');
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
                session()->setFlashdata('register-category-success', 'categoria salva com sucesso!');
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
            // $searchTerm = $this->request->getGet('search');
            // if (!empty($searchTerm)) {
            //     $builder->like('TIPO_CATEGORIA', $searchTerm);
            // }
            $builder->select('
                tipo_categoria_produto.ID,
                tipo_categoria_produto.TIPO_CATEGORIA,

            ');
            $builder->orderBy('ID', 'DESC');
            $builder->limit(10); 

            $query = $builder->get()->getResultArray();
            $db->close();

            // if (!empty($searchTerm)) {
            //     session()->setFlashdata('list-nao-encontrado', 'Nenhum resultado encontrado para a pesquisa: ' . $searchTerm);
            //     return view('/adm/lista-categoria');
            // }

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


    public function editarCategoria($id = null)
    {
        if ($id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        $produto = new Product();
        $categoria_selecionada = $produto->getCategoriaById($id);
        $data = [
            "categoria" => $categoria_selecionada
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
            $builder->where('ID', $id_categoria);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('att-category-failed', 'Tivemos um erro em atualizar sua categoria, por favor tente novamente!');
            } else {
                session()->setFlashdata('att-category-success', 'categoria atualizada com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
        
        
    }

    public function desativarCategoria()
    {
            
        $user = new User();
        if (!$user->validaLoginAdm()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $produto = new Product();
        $id = $this->request->getPost('id-categoria');
    
        $myTime = Time::now('America/Sao_Paulo');
        $data = [
            'ATIVO' => 0,
            'DELETED_AT' => $myTime->toDateTimeString(),
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('tipo_categoria_produto');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();
            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.'
                );

            }
            echo json_encode($response);

            return redirect()->back();

        } catch (\Exception $e) {
            log_message('error', 'Erro na conexão com o banco de dados: ' . $e->getMessage());
            // Lidar com o erro de forma adequada, exibir uma mensagem de erro amigável ao usuário, etc.
        }
        
    }


    public function editarProduto($id_produto)
    {
        if ($id_produto == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $user = new User();
            if (!$user->validaLoginAdm())
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            $produto = new Product();
            $produto_selecionado = $produto->getProdutoById($id_produto);
            $data = [
                "produto" => $produto_selecionado['produto_selecionado'][0],
                "categorias" => $produto_selecionado['categorias']
            ];
            return
                view('/adm/editar-produto', $data);
        }   
    }

    public function desativarProduto()
    {
        $user = new User();
        if (!$user->validaLoginAdm()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $produto = new Product();
        $id = $this->request->getPost('id-produto');
        $myTime = Time::now('America/Sao_Paulo');
        $data = [
            'ATIVO' => 0,
            'DELETED_AT' => $myTime->toDateTimeString(),
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();
            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.'
                );

            }
            echo json_encode($response);

            return redirect()->back();

        } catch (\Exception $e) {
            log_message('error', 'Erro na conexão com o banco de dados: ' . $e->getMessage());
            // Lidar com o erro de forma adequada, exibir uma mensagem de erro amigável ao usuário, etc.
        }
    }


    public function alterarProduto()
    {
        $myTime = Time::now('America/Sao_Paulo');
        $user = new User();
        $id = $user->idUser();
        $id_produto = $this->request->getPost('id-produto');
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
            'UPDATED_AT' => $myTime->toDateTimeString(),
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
            $builder->where('ID', $id_produto);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('att-produtc-failed', 'Tivemos um erro em salvar seu produto, por favor tente novamente!');
            } else {
                session()->setFlashdata('att-product-success', 'produto salvo com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function desativarUsuario()
    {
        $user = new User();
        if (!$user->validaLoginAdm()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $id = $this->request->getPost('id-user');
        $data = [
            'ATIVO' => 0,
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('usuario');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();
            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.'
                );

            }
            echo json_encode($response);

            return redirect()->back();

        } catch (\Exception $e) {
            log_message('error', 'Erro na conexão com o banco de dados: ' . $e->getMessage());
            // Lidar com o erro de forma adequada, exibir uma mensagem de erro amigável ao usuário, etc.
        }
    }

    public function cadastroOpcaoAdicional()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return
            view('/adm/cadastro-opcoes-adicionais');
    }

    public function insereOpcaoAdicional()
    {
        $myTime = Time::now('America/Sao_Paulo');
        $user = new User();

        $id = $user->idUser();
        $nome_opcao_adicional = $this->request->getPost('nome-opcao-adicional');
        $preco = $this->request->getPost('preco');

        $data = [
            'NOME' => $nome_opcao_adicional,
            'PRECO' => $preco,
            'DELETED_AT' => '',
            'UPDATED_AT' => '',
            'CREATED_AT' => $myTime->toDateTimeString(),
            'ATIVO' => 1
        ];

        try {

            if ($nome_opcao_adicional) {
                $db = \Config\Database::connect();
                $builder = $db->table('opcoes_adicionais');
                if ($builder->where('NOME', $nome_opcao_adicional)->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('option-exists', 'Adicional já cadastrada!');
                    return redirect()->back();
                }
            }

            $db = \Config\Database::connect();
            $builder = $db->table('opcoes_adicionais');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('register-adicional-failed', 'Tivemos um erro em salvar sua Opção Adicional, por favor tente novamente!');
            } else {
                session()->setFlashdata('register-adicional-success', 'Opção Adicional salvo com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function listaOpcoesAdicionais()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

            try {
                $db = \Config\Database::connect();
                $builder = $db->table('opcoes_adicionais');
                $builder->where('ATIVO', 1);
                $builder->select('
                    opcoes_adicionais.ID,
                    opcoes_adicionais.NOME,
                    opcoes_adicionais.PRECO,
                ');
                //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
                $builder->orderBy('ID', 'ASC');
                $builder->limit(10); 
    
                $query = $builder->get()->getResultArray();
                $db->close();
    
                if (empty($query)) {
                    session()->setFlashdata('list-empty', 'A lista está vazia.');
                    return view('/adm/lista-opcoes-adicionais');
                }
                $data = ['opcoes_adicionais' => $query];
    
                return view('/adm/lista-opcoes-adicionais', $data);
            } catch (\Exception $e) {
                echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            }
    }

    public function desativarOpcoesAdicionais()
    {
            
        $user = new User();
        if (!$user->validaLoginAdm()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $produto = new Product();
        $id = $this->request->getPost('id-opcoes-adicionais');
    
        $myTime = Time::now('America/Sao_Paulo');
        $data = [
            'ATIVO' => 0,
            'DELETED_AT' => $myTime->toDateTimeString(),
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('opcoes_adicionais');
            $builder->where('ID', $id);
            $builder->update($data);
            $db->close();
            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.'
                );

            }
            
            echo json_encode($response);

            return redirect()->back();

        } catch (\Exception $e) {
            log_message('error', 'Erro na conexão com o banco de dados: ' . $e->getMessage());
            // Lidar com o erro de forma adequada, exibir uma mensagem de erro amigável ao usuário, etc.
        }
        
    }

    public function editarOpcoesAdicionais($id = null)
    {
        if ($id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $user = new User();
            if (!$user->validaLoginAdm()) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        
            $opcoes_adicionais = new Product();
            $opcao_selecionada = $opcoes_adicionais->getOpcoesById($id);
        
            $data = [
                'opcao_selecionada' => $opcao_selecionada,
            ];
        
            return view('adm/editar-opcoes-adicionais', $data);
        }
    }

    

    public function alterarOpcoesAdicionais()
    {
        $myTime = Time::now('America/Sao_Paulo');
        
        $nome = $this->request->getPost('nome-opcao-adicional');
        $preco = $this->request->getPost('preco');
        $id_opcoes_adicionais = $this->request->getPost('id-opcao-adicional');
        
        $data = [
            'NOME' => $nome,
            'PRECO' => $preco,
            'UPDATED_AT' => $myTime->toDateTimeString(),
        ];

        try {
            if ($nome) {
                $db = \Config\Database::connect();
                $builder = $db->table('opcoes_adicionais');
                if ($builder->where('NOME', $nome)->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('option-exists', 'Adicional já cadastrada!');
                    return redirect()->back();
                }
            }

            $db = \Config\Database::connect();
            $builder = $db->table('opcoes_adicionais');
            $builder->where('ID', $id_opcoes_adicionais);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('att-adicional-failed', 'Tivemos um erro em atualizar seu adicional, por favor tente novamente!');
            } else {
                session()->setFlashdata('att-adcional-success', 'Adicional atualizada com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
        
        
    }
    
    public function listaEstoque()
    {
        $user = new User();
        if (!$user->validaLoginAdm())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('estoque');
            $builder->select('
                estoque.ID,
                estoque.PRODUTO_ID, 
                estoque.QUANTIDADE, 
                produto.NOME as NOME_PRODUTO'
            );
            $builder->join('produto', 'produto.ID = estoque.PRODUTO_ID');
            $builder->orderBy('estoque.PRODUTO_ID', 'DESC');
            $builder->limit(10);

            $query = $builder->get()->getResultArray();
            $db->close();
            // echo "<pre>";  
            // return var_dump($query);
            if (empty($query)) {
                session()->setFlashdata('list-empty', 'A lista está vazia.');
                return view('/adm/lista-estoque');
            }
            $data = ['estoque' => $query];

            return view('/adm/lista-estoque', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function alterarQuantidadeEstoque()
    {
        $quantidade = $this->request->getPost('qtd-estoque');
        $id_qtd_estoque = $this->request->getPost('id-estoque');

        $data = [
            'QUANTIDADE' => $quantidade,
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('estoque');
            $builder->where('ID', $id_qtd_estoque);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Remoção bem-sucedida.'
                );

            }
            
            echo json_encode($response);

            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
        
        
    }


    public function getUsuarioById($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('ATIVO', 1);
        $builder->where('ID', $id_usuario);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function getPessoaById($id_pessoa) {
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('ATIVO', 1);
        $builder->where('ID', $id_pessoa);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

}
