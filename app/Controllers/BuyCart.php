<?php

namespace App\Controllers;

class BuyCart extends BaseController
{
    public function carrinho() {
        if (session()->has('usuario')) {
            $id_usuario = session()->get('id');
            try {
                $db = \Config\Database::connect();
                $builder = $db->table('carrinho_de_compras');
                $builder->select('ID');
                $builder->where('USUARIO_ID', $id_usuario);
                $builder->where("STATUS_COMPRA", 'EM ABERTO');
                $query = $builder->get()->getResultArray();
                $db->close();
                $carrinho_de_compra_id = $query[0]['ID'];
                if ($query != null) {
                    $builder = $db->table('itens_carrinho');
                    $builder->select('
                        itens_carrinho.ID as ID_ITENS_CARRINHO,
                        itens_carrinho.QUANTIDADE,
                        itens_carrinho.PRECO_UNITARIO,
                        itens_carrinho.SUBTOTAL,
                        produto.NOME as NOME_PRODUTO,
                        produto.IMAGEM,
                        produto.SLUG,
                        produto.PRECO
                    ');
                    $builder->where('CARRINHO_DE_COMPRA_ID', $carrinho_de_compra_id);
                    $builder->join('produto', 'produto.ID = itens_carrinho.PRODUTO_ID');
                    $query = $builder->get()->getResultArray();
                    $db->close();

                    // var_dump($query);
                    
                    $data = ['carrinho_compras' => $query];
                    return view('carrinho', $data);
                }
                
            } catch (\Exception $e) {
                echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            } 
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }

    public function somaQuantidade() {
        $id = $this->request->getPost('id');
        $quantidade = $this->request->getPost('quantidade');

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('itens_carrinho');
            $builder->select('ID');
            $builder->set('QUANTIDADE', $quantidade+1);
            $builder->where('ID', $id);
            $builder->update();
            $db->close();
            return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function subtraiQuantidade() {
        $id = $this->request->getPost('id');
        $quantidade = $this->request->getPost('quantidade');

        if ($quantidade == 1) {
            return redirect()->back();
        }

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('itens_carrinho');
            $builder->select('ID');
            $builder->set('QUANTIDADE', $quantidade-1);
            $builder->where('ID', $id);
            $builder->update();
            $db->close();
            return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 

    }

}