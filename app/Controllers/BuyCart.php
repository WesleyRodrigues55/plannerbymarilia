<?php

namespace App\Controllers;
use App\Controllers\User;
use CodeIgniter\I18n\Time;

class BuyCart extends BaseController
{
    public function carrinho() {
        return view('carrinho/carrinho');
    }

    public function loadContentCarrinho() {
        $data = [
            "visao_geral" => $this->loadVisaoGeralContent(),
            "carrinho_compras" => $this->loadItensCarrinhoContent()
        ];

        return view('carrinho/content-carrinho', $data);
    }

    public function loadItensCarrinhoContent() {
        if (session()->has('usuario')) {
            // $id_usuario = session()->get('id');
            $usuario = new User();
            $id_usuario = $usuario->idUser();

            $db = \Config\Database::connect();
            $builder = $db->table('carrinho_de_compras');
            $builder->select('ID');
            $builder->where('USUARIO_ID', $id_usuario);
            $builder->where("STATUS_COMPRA", 'EM ABERTO');
            $query = $builder->get()->getResultArray();
            
            $db->close();

            if ($query == null) {
                return null;
            }
            $carrinho_de_compra_id = $query[0]['ID'];

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

            return $query;
            // return view("carrinho/itens-carrinho", $data);
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
            $response = array(
                'success' => true,
                'message' => 'Inserção bem-sucedida.'
            );
        
            echo json_encode($response);
            // return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function subtraiQuantidade() {
        $id = $this->request->getPost('id');
        $quantidade = $this->request->getPost('quantidade');

        if ($quantidade == 1) {
            $response = array(
                'success' => true,
                'message' => 'Quantidade não pode ser menor que 1.'
            );
            return json_encode($response);
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
            $response = array(
                'success' => true,
                'message' => 'Inserção bem-sucedida.'
            );
        
            echo json_encode($response);
            // return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function getIdCarrinhoCompra($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('carrinho_de_compras');
        $builder->where('STATUS_COMPRA', 'EM ABERTO');
        $builder->where('USUARIO_ID', $id_usuario);
        $id_carrinho_compra = $builder->get()->getRow()->ID ?? null;
        $db->close();
        return $id_carrinho_compra;
    }

    public function ultimoIdInseridoCarrinhoCompras($id_usuario) {
        $myTime = Time::now('America/Sao_Paulo');
        $data = [
            'USUARIO_ID' => $id_usuario,
            'STATUS_COMPRA' => 'EM ABERTO',
            'DATA_CRIACAO' => $myTime->toDateTimeString()
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('carrinho_de_compras');
        $builder->insert($data);
        $ultimo_id_inserido = $db->insertID();
        $db->close();
        return $ultimo_id_inserido;
    }

    public function getValorProdutoSelecionado($id_produto) {
        $db = \Config\Database::connect();
        $builder = $db->table('produto');
        $builder->select("CAST(preco AS DECIMAL(10, 2)) AS preco", FALSE);
        $builder->where('ID', $id_produto);
        $preco_produto = $builder->get()->getRow()->preco;
        $db->close();
        return $preco_produto;
    }

    public function temProdutoCarrinho($id_produto, $id_carrinho_compra) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $tem_produto_carrinho =  $builder->get()->getResultArray();
        $db->close();
        return $tem_produto_carrinho;
    }

    public function updateItemCarrinho($id_produto, $id_carrinho_compra) {
        $db = \Config\Database::connect();
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
        $builder->update();
        $db->close();
    }

    public function inserePrimeiroItemNoCarrinho($ultimo_id_novo_carrinho_inserido, $id_produto, $preco_produto) {
        $data = [
            'CARRINHO_DE_COMPRA_ID' => (int) $ultimo_id_novo_carrinho_inserido,
            'PRODUTO_ID' => (int) $id_produto,
            'QUANTIDADE' => 1,
            'PRECO_UNITARIO' => (float) $preco_produto,
            'SUBTOTAL' => (float) $preco_produto
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->insert($data);
        $db->close();
    }

    public function insereItemNoCarrinho($id_carrinho_compra, $id_produto, $preco_produto) {
        $data = [
            'CARRINHO_DE_COMPRA_ID' => (int) $id_carrinho_compra,
            'PRODUTO_ID' => (int) $id_produto,
            'QUANTIDADE' => 1,
            'PRECO_UNITARIO' => (float) $preco_produto,
            'SUBTOTAL' => (float) $preco_produto
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->insert($data);
        $db->close();
    }

    public function adicionaProdutoCarrinho() {
        $usuario = new User();
        $id_usuario = $usuario->idUser();
        $id_produto = $this->request->getPost('id-produto');

        try {
            $id_carrinho_compra = $this->getIdCarrinhoCompra($id_usuario);
            
            if ($id_carrinho_compra == null) {
                try {
                    // pega o último id inserido no novo carrinho "EM ABERTO"
                    $ultimo_id_novo_carrinho_inserido = $this->ultimoIdInseridoCarrinhoCompras($id_usuario);
                    
                    // pega o preco do produto convertido em float
                    $preco_produto = $this->getValorProdutoSelecionado($id_produto);

                    // insere o primeiro item no carrinho
                    $this->inserePrimeiroItemNoCarrinho($ultimo_id_novo_carrinho_inserido, $id_produto, $preco_produto);
        
                    // adicioanr mensagem para alert em que "vai para o carrinho ou continua comprando"
                    return redirect()->back();
                    // to('admin/home')
                    
                } catch (\Exception $e) {
                    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
                } 
            } else {
                // pega o valor do produto selecionado
                $preco_produto = $this->getValorProdutoSelecionado($id_produto);

                // verificar se o item adicionado tem no carrinho
                $tem_produto_carrinho = $this->temProdutoCarrinho($id_produto, $id_carrinho_compra);

                // se tem item no carrinho ele dá update
                if ($tem_produto_carrinho) {
                    //faz o update na quantidade do produto que já existe no carrinho
                    $this->updateItemCarrinho($id_produto, $id_carrinho_compra);
                } else {
                    //insere o produto que ainda não existia no carrinho
                    $this->insereItemNoCarrinho($id_carrinho_compra, $id_produto, $preco_produto);
                }
            }
            session()->setFlashdata('query-success', 'Quantidade alterada.');
            return redirect()->back();
            
        } catch (\Exception $e) {
            // echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            var_dump('teste');
        } 

    }

    public function temCarrinhoCompras() {
        $db = \Config\Database::connect();
        $builder = $db->table('carrinho_de_compras');
        $builder->select('ID');
        $builder->where('STATUS_COMPRA', 'EM ABERTO');
        // $id = $builder->get()->getRow()->ID;
        $query = $builder->get()->getResultArray();
        $db->close();
        if ($query == null) {
            return $query;
        }
        return $query[0]['ID'];

        // return $id;
    }

    public function loadVisaoGeralContent() {
        $id_carrinho = $this->temCarrinhoCompras();
        if ($id_carrinho == null) {
            $data = [
                'count_itens_carrinho' => "",
                'total_geral' => "",
                'id_carrinho' => ""
            ];
            return $data;
        }
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