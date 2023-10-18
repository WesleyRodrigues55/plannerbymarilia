<?php

namespace App\Controllers;

class Product extends BaseController
{
    public function planners() {
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

        $data = ['planners' => $query];

        return view('produtos/planners', $data);
    }
    public function cadernos() {
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

        $data = ['cadernos' => $query];

        return view('produtos/cadernos', $data);
    }

    public function agendas() {
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

        $data = ['agendas' => $query];

        return view('produtos/agendas', $data);
    }

    public function blocos() {
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

        $data = ['blocos' => $query];

        return view('produtos/blocos', $data);
    }

    public function maisVendidosSemana() {
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

        $data = ['mais_vendidos' => $query];

        return view('produtos/mais-vendidos-semana', $data);
    }

    public function presentesCriativos() {
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

        $data = ['presentes_criativos' => $query];

        return view('produtos/presentes-criativos', $data);
    }

    public function plannersHome() {
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

        return $query;
    }

    public function presentesCriativosHome() {
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

        return $query;
    }

    public function maisVendidosHome() {
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

        return $query;
    }
}
