<?php

namespace App\Controllers;

class ProductCategoryType extends BaseController
{
    public function tipoCategoriasProdutos() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('tipo_categoria_produto');
            $builder->where('ATIVO', 1);
    
            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-failed', 'Error ao filtrar dados.');
            }

            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }
}
