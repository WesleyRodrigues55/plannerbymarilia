<?php

namespace App\Controllers;
use App\Controllers\User;

class BuyCart extends BaseController
{
    public function carrinho() {
        if (session()->has('usuario')) {
            $id_usuario = session()->get('id');
            $visao_geral = $this->visaoGeralCarrinho();
            try {
                $db = \Config\Database::connect();
                $builder = $db->table('carrinho_de_compras');
                $builder->select('ID');
                $builder->where('USUARIO_ID', $id_usuario);
                $builder->where("STATUS_COMPRA", 'EM ABERTO');
                $query = $builder->get()->getResultArray();
                $carrinho_de_compra_id = $query[0]['ID'];
                $db->close();
                

                try {
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

                } catch (\Exception $e) {
                    session()->setFlashdata('query-failed', 'Tivemos um erro em consultar os itens do seu carrinho!');
                }   
            } catch (\Exception $e) {
                session()->setFlashdata('query-failed', 'Tivemos um erro em consultar os itens do seu carrinho!');
            } 

            $data = [
                'carrinho_compras' => $query,
                'visao_geral' => $visao_geral
            ];
            return view('carrinho', $data);
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
            // $builder->select('ID');
            $builder->where('ID', $id);
            $preco_unitario = $builder->get()->getRow()->PRECO_UNITARIO;
            $builder->where('ID', $id);
            $subtotal = $builder->get()->getRow()->SUBTOTAL;
            $builder->set('QUANTIDADE', $quantidade+1);
            $builder->set('SUBTOTAL', $subtotal + $preco_unitario);
            $builder->where('ID', $id);
            $builder->update();
            // $query = $builder->getCompiledUpdate(); 
            $db->close();

            if (!$builder) {
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

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
            // $builder->select('ID');
            $builder->where('ID', $id);
            $preco_unitario = $builder->get()->getRow()->PRECO_UNITARIO;
            $builder->where('ID', $id);
            $subtotal = $builder->get()->getRow()->SUBTOTAL;
            $builder->set('QUANTIDADE', $quantidade - 1);
            $builder->set('SUBTOTAL', $subtotal - $preco_unitario);
            $builder->where('ID', $id);
            $builder->update();
            $db->close();
            
            if (!$builder) {
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function adicionaProdutoCarrinho() {
        helper('date');
        $usuario = new User();
        $id_usuario = $usuario->idUser();
        $id_produto = $this->request->getPost('id-produto');

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('carrinho_de_compras');
            $builder->where('STATUS_COMPRA', 'EM ABERTO');
            $builder->where('USUARIO_ID', $id_usuario);
            $id_carrinho_compra = $builder->get()->getRow()->ID ?? null;
            // $query = $builder->getCompiledSelect(); 
            $db->close();

            if ($id_carrinho_compra == null) {
                try {
                    $data = [
                        'USUARIO_ID' => $id_usuario,
                        'STATUS_COMPRA' => 'EM ABERTO',
                        'DATA_CRIACAO' => now()
                    ];
                    $builder = $db->table('carrinho_de_compras');
                    $builder->insert($data);
                    $ultimo_id_inserido = $db->insertID();
                    $db->close();

                    $builder = $db->table('produto');
                    $builder->select("CAST(preco AS DECIMAL(10, 2)) AS preco", FALSE);
                    $builder->where('ID', $id_produto);
                    $preco_produto = $builder->get()->getRow()->preco;
                    $db->close();

                    $data = [
                        'CARRINHO_DE_COMPRA_ID' => (int) $ultimo_id_inserido,
                        'PRODUTO_ID' => (int) $id_produto,
                        'QUANTIDADE' => 1,
                        'PRECO_UNITARIO' => (float) $preco_produto,
                        'SUBTOTAL' => (float) $preco_produto
                    ];

                    $builder = $db->table('itens_carrinho');
                    $builder->insert($data);
                    $db->close();

                    
                    if (!$builder) {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
        
                    // return redirect()->back();
                    
                } catch (\Exception $e) {
                    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
                } 
            } else {
                $builder = $db->table('produto');
                $builder->select("CAST(preco AS DECIMAL(10, 2)) AS preco", FALSE);
                $builder->where('ID', $id_produto);
                $preco_produto = $builder->get()->getRow()->preco;
                $db->close();
                
                $builder = $db->table('itens_carrinho');
                $builder->where('PRODUTO_ID', $id_produto);
                $tem_produto_carrinho =  $builder->get()->getResultArray();
                $db->close();
                    echo "<pre>";
                    var_dump($tem_produto_carrinho);
                
                if ($tem_produto_carrinho) {
                    $builder = $db->table('itens_carrinho');

                    $builder->where('PRODUTO_ID', $id_produto);
                    $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
                    $quantidade_atual = $builder->get()->getRow()->QUANTIDADE;

                    $builder->where('PRODUTO_ID', $id_produto);
                    $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
                    $preco_unitario = $builder->get()->getRow()->PRECO_UNITARIO;

                    $builder->where('PRODUTO_ID', $id_produto);
                    $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
                    $subtotal = $builder->get()->getRow()->SUBTOTAL;
                    
                    $builder->set('QUANTIDADE', $quantidade_atual + 1);
                    $builder->set('SUBTOTAL', $preco_unitario + $subtotal);
                    $builder->where('PRODUTO_ID', $id_produto);
                    $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
                    // $builder->update();
                    // $query = $builder->getCompiledUpdate(); 
                    // var_dump($query);
                    $db->close();
                } else {
                    $data = [
                        'CARRINHO_DE_COMPRA_ID' => (int) $id_carrinho_compra,
                        'PRODUTO_ID' => (int) $id_produto,
                        'QUANTIDADE' => 1,
                        'PRECO_UNITARIO' => (float) $preco_produto,
                        'SUBTOTAL' => (float) $preco_produto
                    ];

                    $builder = $db->table('itens_carrinho');
                    $builder->insert($data);
                    $db->close();

                    // var_dump($builder);
                }
            }

            // return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 

    }

    public function temCarrinhoCompras() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('carrinho_de_compras');
            $builder->where('STATUS_COMPRA', 'EM ABERTO');
            $id = $builder->get()->getRow()->ID;
            $db->close();
            return $id;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function visaoGeralCarrinho() {
        $id_carrinho = $this->temCarrinhoCompras();
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('itens_carrinho');
            $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho);
            $query = $builder->get()->getResultArray();

            $total_geral = 0;
            foreach ($query as $q) {
                $total_geral += $q['SUBTOTAL'];
            }

            $count_itens_carrinho = count($query);

            $data = [
                'count_itens_carrinho' => $count_itens_carrinho,
                'total_geral' => $total_geral,
                'id_carrinho' => $id_carrinho
            ];

            return $data;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }


}