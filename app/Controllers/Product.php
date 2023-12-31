<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function planners() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            $builder->where('produto.CATEGORIA', 'planner');
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');

    
            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }

            $data = ['planners' => $query];
    
            return view('produtos/planners', $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } 
    }
    public function cadernos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            $builder->where('produto.CATEGORIA', 'caderno');
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
    
            $query = $builder->get()->getResultArray();
            $db->close();
            
            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['cadernos' => $query];
    
            return view('produtos/cadernos', $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }

    public function agendas() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            $builder->where('produto.CATEGORIA', 'agenda');
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['agendas' => $query];

            return view('produtos/agendas', $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function blocos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            $builder->where('produto.CATEGORIA', 'bloco');
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['blocos' => $query];

            return view('produtos/blocos', $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function maisVendidosSemana() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
            $builder->orderBy('RAND()');
            $builder->limit(4); 

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['mais_vendidos' => $query];

            return view('produtos/mais-vendidos-semana', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function presentesCriativos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
            $builder->orderBy('RAND()');
            $builder->limit(4); 

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['presentes_criativos' => $query];

            return view('produtos/presentes-criativos', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function plannersHome() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            $builder->where('produto.CATEGORIA', 'planner');
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
            $builder->limit(4);

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-planners-failed', 'Error ao filtrar dados.');
            }
            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function presentesCriativosHome() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');           
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
            $builder->orderBy('RAND()');
            $builder->limit(4); 
            
            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-presentes-criativos-failed', 'Error ao filtrar dados.');
            }
            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function maisVendidosHome() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                produto.ID,
                produto.NOME,
                produto.IMAGEM,
                produto.PRECO,
                produto.SLUG,
                produto.CATEGORIA
            ');
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS 
            $builder->where('produto.ATIVO', 1);
            $builder->where('estoque.QUANTIDADE >',  0);
            $builder->join('estoque', 'produto.ID = estoque.PRODUTO_ID');
            $builder->orderBy('RAND()');
            $builder->limit(4); 

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-mais-vendidos-failed', 'Error ao filtrar dados.');
            }
            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function pageProdutos($categoria = false, $slug = false, $id = false)
    {
        if ($categoria == "" || $slug == "" || $id == "") {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } 

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->where('ID', $id);
            $builder->where('CATEGORIA', $categoria);
            $builder->where('SLUG', $slug);
            $builder->where('ATIVO', 1);
    
            $query = $builder->get()->getResultArray();
            $db->close();
            $opcoes_adicionais = $this->getOpcoesAdicionais();
            $capas_internas = $this->getCapasInternas($id);
            if ($query == null || $opcoes_adicionais == null) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $data = [
                'produto_selecionado' => $query,
                'opcoes_adicionais' => $opcoes_adicionais,
                'capas_internas_produto' => $capas_internas,
            ];
            return view('produtos/produto-selecionado', $data);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }   
    }

    private function getCapasInternas($id_produto) {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('capas_produtos');
            $builder->where('PRODUTO_ID', $id_produto);
            $builder->where('ATIVO', 1);

            $query = $builder->get()->getResultArray();
            $db->close();

            if ($query == null) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    private function getOpcoesAdicionais() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('opcoes_adicionais');
            $builder->where('ATIVO', 1);

            $query = $builder->get()->getResultArray();
            $db->close();

            if ($query == null) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function getCategorias() {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_categoria_produto');
        $builder->where('ATIVO', 1);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    
    public function getCategoriaById($id) {
        $db = \Config\Database::connect();
        $builder = $db->table('tipo_categoria_produto');
        $builder->where('ATIVO', 1);
        $builder->where('ID', $id);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function getOpcoesById($id) {
        $db = \Config\Database::connect();
        $builder = $db->table('opcoes_adicionais');
        $builder->where('ATIVO', 1);
        $builder->where('ID', $id);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function getProdutoById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produto');
        $builder->where('ID', $id);
        $builder->where('ATIVO', 1);

        $query = $builder->get()->getResultArray();
        $db->close();
        $categorias = $this->getCategorias();

        if ($query == null || $categorias == null) {
            //produto não existe - fazer página de erro
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'produto_selecionado' => $query,
            'categorias' => $categorias
        ];
        return $data;
    }


}
