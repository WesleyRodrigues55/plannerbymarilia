<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function planners() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('CATEGORIA', 'planner');
            $builder->where('ATIVO', 1);
    
            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }

            $data = ['planners' => $query];
    
            return view('produtos/planners', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }
    public function cadernos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('CATEGORIA', 'caderno');
            $builder->where('ATIVO', 1);
    
            $query = $builder->get()->getResultArray();
            $db->close();
            
            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['cadernos' => $query];
    
            return view('produtos/cadernos', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
        
    }

    public function agendas() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('CATEGORIA', 'agenda');
            $builder->where('ATIVO', 1);

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['agendas' => $query];

            return view('produtos/agendas', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function blocos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('CATEGORIA', 'bloco');
            $builder->where('ATIVO', 1);

            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }
            $data = ['blocos' => $query];

            return view('produtos/blocos', $data);
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function maisVendidosSemana() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('produto');
            $builder->select('
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS  
            $builder->where('ATIVO', 1);
            $builder->orderBy('ID', 'RANDOM');

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
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');  
            $builder->where('ATIVO', 1);
            $builder->orderBy('ID', 'RANDOM');

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
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('CATEGORIA', 'planner');
            $builder->where('ATIVO', 1);
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
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('ATIVO', 1);
            $builder->orderBy('ID', 'RANDOM');
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
                ID,
                NOME,
                IMAGEM,
                PRECO,
                SLUG,
                CATEGORIA
            ');
            $builder->where('ATIVO', 1);
            //FAZER QUERY QUE CONSULTE A TABELA DE VENDAS E FILTRE OS PRODUTOS QUE FORAM MAIS VENDIDOS
            $builder->orderBy('ID', 'RANDOM');
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

    public function pagePlanners($categoria = false, $slug = false, $id = false)
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

            if ($query == null || $opcoes_adicionais == null) {
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $data = [
                'produto_selecionado' => $query,
                'opcoes_adicionais' => $opcoes_adicionais
            ];
            return view('produtos/produto-selecionado', $data);
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
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }


}
