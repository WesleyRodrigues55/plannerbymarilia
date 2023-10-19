<?php

namespace App\Controllers;

class Testimony extends BaseController
{
    public function depoimentosHome() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('depoimentos');
    
            $query = $builder->get()->getResultArray();
            $db->close();
    
            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

}