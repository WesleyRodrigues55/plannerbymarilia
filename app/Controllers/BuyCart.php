<?php

namespace App\Controllers;
use App\Controllers\User;
use App\Controllers\DeliveryAdress;

use CodeIgniter\I18n\Time;

class BuyCart extends BaseController
{
    public function carrinho() {
        return view('comprando/carrinho/carrinho');
    }

    public function loadContentCarrinho() {
        $data = [
            "visao_geral" => $this->loadVisaoGeralContent(),
            "carrinho_compras" => $this->loadItensCarrinhoContent()
        ];

        return view('comprando/carrinho/content-carrinho', $data);
    }

    public function loadItensCarrinhoContent() {
        if (session()->has('usuario')) {
            // $id_usuario = session()->get('id');
            $usuario = new User();
            $id_usuario = $usuario->idUser();

            $db = \Config\Database::connect();
            $builder = $db->table('carrinho_de_compras');
            // $builder->select('ID');
            $builder->where("STATUS_COMPRA", 'EM ABERTO');
            $builder->where('USUARIO_ID', $id_usuario);
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
                produto.PRECO,
                estoque.QUANTIDADE as QUANTIDADE_ESTOQUE
            ');
            $builder->where('CARRINHO_DE_COMPRA_ID', $carrinho_de_compra_id);
            $builder->join('produto', 'produto.ID = itens_carrinho.PRODUTO_ID');
            $builder->join('estoque', 'estoque.PRODUTO_ID = produto.ID');
            $query = $builder->get()->getResultArray();
            $db->close();

            return $query;
            // return view("carrinho/itens-carrinho", $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getQuantidadeItemCarrinhoPorId($id_item_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('ID', $id_item_carrinho);
        $quantidade = $builder->get()->getRow()->QUANTIDADE;
        $db->close();
        return $quantidade;
    }

    public function getIdProdutoItemCarrinho($id_item_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('ID', $id_item_carrinho);
        $id_produto = $builder->get()->getRow()->PRODUTO_ID;
        $db->close();
        return $id_produto;
    }

    public function removeItemCarrinho() {
        $id = $this->request->getPost('id');
        $quantidade_item_carrinho = $this->getQuantidadeItemCarrinhoPorId($id);
        $id_produto = $this->getIdProdutoItemCarrinho($id);

        $db = \Config\Database::connect();
        $builder = $db->table('estoque');
        $builder->where('PRODUTO_ID', $id_produto);
        $quantidade_carrinho = $builder->get()->getRow()->QUANTIDADE;
        $builder->set('QUANTIDADE', $quantidade_carrinho + $quantidade_item_carrinho);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->update();

        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('ID', $id);
        $builder->delete();
        $db->close();

        $response = array(
            'success' => true,
            'message' => 'Remoção bem-sucedida.'
        );
    
        echo json_encode($response);
    }

    public function verificaEstoque($id_itens_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->select('
            estoque.QUANTIDADE as QUANTIDADE_ESTOQUE
        ');
        $builder->where('itens_carrinho.ID', $id_itens_carrinho);
        $builder->join('estoque', 'estoque.PRODUTO_ID = itens_carrinho.PRODUTO_ID');
        return $builder->get()->getRow()->QUANTIDADE_ESTOQUE;
    }

    public function somaQuantidade() {
        $id_itens_carrinho = $this->request->getPost('id');
        $quantidade = $this->request->getPost('quantidade');

        $quantidade_estoque = $this->verificaEstoque($id_itens_carrinho);
        if ($quantidade_estoque == 0) {
            $response = array(
                'success' => true,
                'message' => 'success'
            );
            return json_encode($response);
        }

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('itens_carrinho');
            // $builder->select('ID');
            $builder->where('ID', $id_itens_carrinho);
            $preco_unitario = $builder->get()->getRow()->PRECO_UNITARIO;
            $builder->where('ID', $id_itens_carrinho);
            $subtotal = $builder->get()->getRow()->SUBTOTAL;
            $builder->where('ID', $id_itens_carrinho);
            $id_produto = $builder->get()->getRow()->PRODUTO_ID;
            $builder->set('QUANTIDADE', $quantidade+1);
            $builder->set('SUBTOTAL', $subtotal + $preco_unitario);
            $builder->where('ID', $id_itens_carrinho);
            $builder->update();
            // $query = $builder->getCompiledUpdate(); 
            $db->close();

            if (!$builder) {
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $this->removeQuantidadeEstoque($id_produto);
            $response = array(
                'success' => true,
                'message' => 'success'
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
                'message' => 'success'
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
            $builder->where('ID', $id);
            $id_produto = $builder->get()->getRow()->PRODUTO_ID;
            $builder->set('QUANTIDADE', $quantidade - 1);
            $builder->set('SUBTOTAL', $subtotal - $preco_unitario);
            $builder->where('ID', $id);
            $builder->update();
            $db->close();

            if (!$builder) {
                //produto não existe - fazer página de erro
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $this->retornaQuantidadeEstoque($id_produto);
            $response = array(
                'success' => true,
                'message' => 'success'
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

    public function temProdutoCarrinho($id_produto, $id_carrinho_compra, $layout_planner, $nome_capa, $fonte, $divisorias, $cantoneiras) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $builder->where('LAYOUT_PLANNER', $layout_planner);
        $builder->where('NOME_CAPA', $nome_capa);
        $builder->where('FONTE', $fonte);
        $builder->where('DIVISORIAS', $divisorias);
        $builder->where('CANTONEIRAS', $cantoneiras);
        $tem_produto_carrinho =  $builder->get()->getResultArray();
        $db->close();
        return $tem_produto_carrinho;
    }

    public function updateItemCarrinho($id_produto, $id_carrinho_compra, $layout_planner, $nome_capa, $fonte, $preco_final, $divisorias, $cantoneiras) {
        $this->removeQuantidadeEstoque($id_produto);
        
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');

        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $builder->where('LAYOUT_PLANNER', $layout_planner);
        $builder->where('NOME_CAPA', $nome_capa);
        $builder->where('FONTE', $fonte);
        $builder->where('DIVISORIAS', $divisorias);
        $builder->where('CANTONEIRAS', $cantoneiras);
        $quantidade_atual = $builder->get()->getRow()->QUANTIDADE;

        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $builder->where('LAYOUT_PLANNER', $layout_planner);
        $builder->where('NOME_CAPA', $nome_capa);
        $builder->where('FONTE', $fonte);
        $builder->where('DIVISORIAS', $divisorias);
        $builder->where('CANTONEIRAS', $cantoneiras);
        $preco_unitario = $builder->get()->getRow()->PRECO_UNITARIO;

        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $builder->where('LAYOUT_PLANNER', $layout_planner);
        $builder->where('NOME_CAPA', $nome_capa);
        $builder->where('FONTE', $fonte);
        $builder->where('DIVISORIAS', $divisorias);
        $builder->where('CANTONEIRAS', $cantoneiras);
        $subtotal = $builder->get()->getRow()->SUBTOTAL;
        
        $builder->set('QUANTIDADE', $quantidade_atual + 1);
        $builder->set('SUBTOTAL', $preco_final + $subtotal);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho_compra);
        $builder->where('LAYOUT_PLANNER', $layout_planner);
        $builder->where('NOME_CAPA', $nome_capa);
        $builder->where('FONTE', $fonte);
        $builder->where('DIVISORIAS', $divisorias);
        $builder->where('CANTONEIRAS', $cantoneiras);
        $builder->update();
        $db->close();

        $response = array(
            'success' => true,
            'message' => 'Adição bem-sucedida.'
        );
    
        echo json_encode($response);
    }

    public function removeQuantidadeEstoque($id_produto) {
        $db = \Config\Database::connect();
        $builder = $db->table('estoque');
        $builder->where('PRODUTO_ID', $id_produto);
        $quantidade = $builder->get()->getRow('QUANTIDADE');
        $builder->set('QUANTIDADE', $quantidade -1);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->update();
    }

    public function retornaQuantidadeEstoque($id_produto) {
        $db = \Config\Database::connect();
        $builder = $db->table('estoque');
        $builder->where('PRODUTO_ID', $id_produto);
        $quantidade = $builder->get()->getRow('QUANTIDADE');
        $builder->set('QUANTIDADE', $quantidade + 1);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->update();
    }

    public function inserePrimeiroItemNoCarrinho($data_insere_primeiro_produto_carrinho) {
        $this->removeQuantidadeEstoque($data_insere_primeiro_produto_carrinho['id_produto']);
        $data = [
            'CARRINHO_DE_COMPRA_ID' => (int) $data_insere_primeiro_produto_carrinho['ultimo_id_novo_carrinho_inserido'],
            'PRODUTO_ID' => (int) $data_insere_primeiro_produto_carrinho['id_produto'],
            'QUANTIDADE' => 1,
            'LAYOUT_PLANNER' => $data_insere_primeiro_produto_carrinho['layout_planner'],
            'NOME_CAPA' => $data_insere_primeiro_produto_carrinho['nome_capa'],
            'FONTE' => $data_insere_primeiro_produto_carrinho['fonte'],
            'DIVISORIAS' => $data_insere_primeiro_produto_carrinho['divisorias'],
            'CANTONEIRAS' => $data_insere_primeiro_produto_carrinho['cantoneiras'],
            'PRECO_UNITARIO' => (float) $data_insere_primeiro_produto_carrinho['preco_produto'],
            'SUBTOTAL' => (float) $data_insere_primeiro_produto_carrinho['subtotal']
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->insert($data);
        $db->close();

        $response = array(
            'success' => true,
            'message' => 'Adição bem-sucedida.'
        );
    
        echo json_encode($response);
    }

    public function insereItemNoCarrinho($data_insere_produto_carrinho) {
        $this->removeQuantidadeEstoque($data_insere_produto_carrinho['id_produto']);
        $data = [
            'CARRINHO_DE_COMPRA_ID' => (int) $data_insere_produto_carrinho['id_carrinho_compra'],
            'PRODUTO_ID' => (int) $data_insere_produto_carrinho['id_produto'],
            'QUANTIDADE' => 1,
            'LAYOUT_PLANNER' => $data_insere_produto_carrinho['layout_planner'],
            'NOME_CAPA' => $data_insere_produto_carrinho['nome_capa'],
            'FONTE' => $data_insere_produto_carrinho['fonte'],
            'DIVISORIAS' => $data_insere_produto_carrinho['divisorias'],
            'CANTONEIRAS' => $data_insere_produto_carrinho['cantoneiras'],
            'PRECO_UNITARIO' => (float) $data_insere_produto_carrinho['preco_produto'],
            'SUBTOTAL' => (float) $data_insere_produto_carrinho['subtotal']
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->insert($data);
        $db->close();

        $response = array(
            'success' => true,
            'message' => 'Adição bem-sucedida.'
        );
    
        echo json_encode($response);
    }

    public function adicionaProdutoCarrinho() {
        $usuario = new User();
        $id_usuario = $usuario->idUser();
        $id_produto = $this->request->getPost('id-produto');

        // vai para itens
        $layout_planner = $this->request->getPost('layout-planner');
        $nome_capa = $this->request->getPost('nome-capa');
        $fonte = $this->request->getPost('fonte-capa');
        $divisorias = $this->request->getPost('divisorias');
        $cantoneiras = $this->request->getPost('cantoneiras');
        $preco_final = $this->request->getPost('preco-final');
        $preco_original_produto = $this->request->getPost('preco-original-produto');

        if ($cantoneiras == "10.00") {
            $cantoneiras = 1;
        } else {
            $cantoneiras = 0;
        }
        if ($divisorias == "18.00") {
            $divisorias = 1;
        } else {
            $divisorias = 0;
        }

        try {
            $id_carrinho_compra = $this->getIdCarrinhoCompra($id_usuario);
            
            if (!$id_carrinho_compra) {
                try {
                    // pega o último id inserido no novo carrinho "EM ABERTO"
                    $ultimo_id_novo_carrinho_inserido = $this->ultimoIdInseridoCarrinhoCompras($id_usuario);

                    $data_insere_primeiro_produto_carrinho = [
                        'ultimo_id_novo_carrinho_inserido' => $ultimo_id_novo_carrinho_inserido,
                        'id_produto' => $id_produto,
                        'layout_planner' => $layout_planner,
                        'nome_capa' => $nome_capa,
                        'fonte' => $fonte,
                        'divisorias' => $divisorias,
                        'cantoneiras' =>  $cantoneiras,
                        'preco_produto' => $preco_original_produto,
                        'subtotal' => $preco_final
                    ];
                    // insere o primeiro item no carrinho e retorna o id do item inserido
                    $this->inserePrimeiroItemNoCarrinho($data_insere_primeiro_produto_carrinho);         
        
                    // adicioanr mensagem para alert em que "vai para o carrinho ou continua comprando"
                    return redirect()->back();
                    // to('admin/home')
                    
                } catch (\Exception $e) {
                    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
                } 
            } else {
                // verificar se o item adicionado tem no carrinho
                $tem_produto_carrinho = $this->temProdutoCarrinho($id_produto, $id_carrinho_compra, $layout_planner, $nome_capa, $fonte, $divisorias, $cantoneiras);

                // se tem item no carrinho ele dá update
                if ($tem_produto_carrinho) {
                    //faz o update na quantidade do produto que já existe no carrinho
                    $this->updateItemCarrinho($id_produto, $id_carrinho_compra, $layout_planner, $nome_capa, $fonte, $preco_final, $divisorias, $cantoneiras);
                } else {
                    $data_insere_produto_carrinho = [
                        'id_carrinho_compra' => $id_carrinho_compra,
                        'id_produto' => $id_produto,
                        'layout_planner' => $layout_planner,
                        'nome_capa' => $nome_capa,
                        'fonte' => $fonte,
                        'divisorias' => $divisorias,
                        'cantoneiras' =>  $cantoneiras,
                        'preco_produto' => $preco_original_produto,
                        'subtotal' => $preco_final
                    ];
                    //insere o produto que ainda não existia no carrinho
                    $this->insereItemNoCarrinho($data_insere_produto_carrinho);
                }
            }

            $response = array(
                'success' => true,
                'message' => 'Produto adicionado no carrinho.'
            );
        
            echo json_encode($response);
            return redirect()->back();
            
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 

    }

    public function temCarrinhoCompras() {
        $usuario = new User();
        $id_usuario = $usuario->idUser();

        $db = \Config\Database::connect();
        $builder = $db->table('carrinho_de_compras');
        $builder->select('ID');
        $builder->where('STATUS_COMPRA', 'EM ABERTO');
        $builder->where('USUARIO_ID', $id_usuario);
        $query = $builder->get()->getResultArray();
        $db->close();
        if ($query == null) {
            return $query;
        }
        return $query[0]['ID'];
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

    public function getDetalhesPedido($id_carrinho, $id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
        $builder->where('USUARIO_ID', $id_usuario);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function adicionaEnderecoDeEntregaEmDetalhesPedido() {
        $endereco_de_entrega = new DeliveryAdress();
        $myTime = Time::now('America/Sao_Paulo');

        $id_carrinho = $this->request->getPost('id-carrinho');
        $id_endereco_escolhido = $this->request->getPost('id-endereco-escolhido');
        $id_usuario = $this->request->getPost('id-usuario');

        if (session()->has('usuario') && $id_usuario == session()->get('id')) {
            //subtotal - query que consulta itens carrinho, soma total de compras e quantidade e retorna o total
            $db = \Config\Database::connect();
            $builder = $db->table('itens_carrinho');
            $builder->select('SUBTOTAL');
            $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho);
            $query = $builder->get()->getResultArray();

            $subtotal = 0;
            foreach ($query as $key) {
                $subtotal += (double) $key['SUBTOTAL'];
            }

            $endereco_de_entrega->updatedRemoveCheckedEnderecoEntrega($id_usuario);
            $endereco_de_entrega->addCheckedEnderecoEntrega($id_endereco_escolhido, $id_usuario);

            if ($this->getDetalhesPedido($id_carrinho, $id_usuario)) {
                $db = \Config\Database::connect();
                $builder = $db->table('detalhes_do_pedido');
                $builder->set('DATA_PEDIDO', $myTime->toDateTimeString());
                $builder->set('TOTAL_PEDIDO', $subtotal);
                $builder->set('ENDERECO_DE_ENTREGA_ID', $id_endereco_escolhido);
                $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
                $builder->where('USUARIO_ID', $id_usuario);
                $builder->update();
                $db->close();
            } else {
                $data = [
                    'CARRINHO_DE_COMPRAS_ID' => $id_carrinho,
                    'ENDERECO_DE_ENTREGA_ID' => $id_endereco_escolhido,
                    'USUARIO_ID' => $id_usuario,
                    'FORMA_DE_PAGAMENTO' => '',
                    'DATA_PEDIDO' => $myTime->toDateTimeString(),
                    'STATUS_PEDIDO' => 'pending',
                    'TOTAL_PEDIDO' => $subtotal
                ];

                $db = \Config\Database::connect();
                $builder = $db->table('detalhes_do_pedido');
                $builder->insert($data);
                $db->close();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return redirect()->to('comprando/formas-de-pagamento/'. $id_carrinho . '/' . $id_usuario);
        // return view('comprando/forma-de-pagamento/escolhendo-forma-de-pagamento');
    }

    public function formasDePagamento($id_carrinho, $id_usuario) {
        if (session()->has('usuario') && $id_usuario == session()->get('id')) {
            $data = [
                'id_carrinho' => $id_carrinho,
                'id_usuario' => $id_usuario
            ];
            return view('comprando/forma-de-pagamento/formas-de-pagamento', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }

    public function formaDePagamentoEscolhida() {
        $myTime = Time::now('America/Sao_Paulo');
        $id_carrinho = $this->request->getPost('id-carrinho');
        $id_usuario = $this->request->getPost('id-usuario');
        $forma_de_pagamento = $this->request->getPost('forma-de-pagamento');

        if (session()->has('usuario') && $id_usuario == session()->get('id')) {

            if ($this->getDetalhesPedido($id_carrinho, $id_usuario)) {
                $db = \Config\Database::connect();
                $builder = $db->table('detalhes_do_pedido');
                $builder->set('DATA_PEDIDO', $myTime->toDateTimeString());
                $builder->set('FORMA_DE_PAGAMENTO', $forma_de_pagamento);
                $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
                $builder->where('USUARIO_ID', $id_usuario);
                $builder->update();
                $db->close();
            } else {
                session()->setFlashdata('query-failed', 'Error ao salvar forma de pagamento.<br> Tente novamente!');
                return redirect()->back();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return redirect()->to('comprando/revisao/' . $id_carrinho . '/' . $id_usuario);
    }

    public function getDadosDetalhesCompra($id_carrinho, $id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->select('
            DETALHES_DO_PEDIDO.ID as ID_DETALHES_DO_PEDIDO,
            DETALHES_DO_PEDIDO.FORMA_DE_PAGAMENTO,
            DETALHES_DO_PEDIDO.TOTAL_PEDIDO as VALOR_TOTAL,
            DETALHES_DO_PEDIDO.CARRINHO_DE_COMPRAS_ID as ID_CARRINHO,
            USUARIO.ID as ID_USUARIO,
            ENDERECO_DE_ENTREGA.ID as ID_ENDERECO,
            ENDERECO_DE_ENTREGA.RUA,
            ENDERECO_DE_ENTREGA.NUMERO,
            ENDERECO_DE_ENTREGA.CIDADE,
            ENDERECO_DE_ENTREGA.ESTADO,
            ENDERECO_DE_ENTREGA.CEP,
            ENDERECO_DE_ENTREGA.NOME_COMPLETO,
            ENDERECO_DE_ENTREGA.CELULAR,
            PESSOA.CPF
        ');
        $builder->where("DETALHES_DO_PEDIDO.CARRINHO_DE_COMPRAS_ID", $id_carrinho);
        $builder->where("DETALHES_DO_PEDIDO.USUARIO_ID", $id_usuario);
        $builder->join('carrinho_de_compras', 'carrinho_de_compras.ID = detalhes_do_pedido.CARRINHO_DE_COMPRAS_ID');
        $builder->join('endereco_de_entrega', 'endereco_de_entrega.ID = detalhes_do_pedido.ENDERECO_DE_ENTREGA_ID');
        $builder->join('usuario', 'usuario.ID = detalhes_do_pedido.USUARIO_ID');
        $builder->join('pessoa', 'pessoa.ID = usuario.PESSOA_ID');
        $query = $builder->get()->getResultArray();
        $db->close();

        return $query;
    }

    public function getItensCarrinho($id_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->select('
            itens_carrinho.ID as ID_ITENS_CARRINHO,
            itens_carrinho.QUANTIDADE,
            itens_carrinho.PRECO_UNITARIO,
            itens_carrinho.SUBTOTAL,
            produto.NOME as NOME_PRODUTO,
            produto.IMAGEM,
            produto.SLUG,
            produto.PRECO,
        ');
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho);
        $builder->join('produto', 'produto.ID = itens_carrinho.PRODUTO_ID');
        $query = $builder->get()->getResultArray();
        $db->close();

        return $query;
    }

    public function revisaoCompra($id_carrinho, $id_usuario) {
        if (session()->has('usuario') && $id_usuario == session()->get('id')) {

            $total_pedido = $this->getValorTotalCarrinho($id_carrinho);

            $db = \Config\Database::connect();
            $builder = $db->table('detalhes_do_pedido');
            $builder->set('TOTAL_PEDIDO', $total_pedido);
            $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
            $builder->where('USUARIO_ID', $id_usuario);
            $builder->update();
            $db->close();

            $data = [ 
                'detalhes_do_pedido' => $this->getDadosDetalhesCompra($id_carrinho, $id_usuario),
                'itens_carrinho' => $this->getItensCarrinho($id_carrinho)
            ];

            return view('comprando/revisao-geral', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getValorTotalCarrinho($id_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('itens_carrinho');
        $builder->where('CARRINHO_DE_COMPRA_ID', $id_carrinho);
        $query = $builder->get()->getResultArray();

        $total_geral = 0;
        foreach ($query as $q) {
            $total_geral += $q['SUBTOTAL'];
        }

        return $total_geral;
    }

    public function getValorTotalCompra($id_carrinho) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
        $total = $builder->get()->getRow('TOTAL_PEDIDO');
        $db->close();

        return $total;
    }

    public function alteraStatusDetalhePedido($id_detalhes_pedido) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->set('STATUS_PEDIDO', 'approved');
        $builder->where('ID', $id_detalhes_pedido);
        $builder->update();
        $db->close();
    }

    public function getIdCarrinhoPorDetalhePedido($id_detalhes_pedido) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('ID', $id_detalhes_pedido);
        $id_carrinho = $builder->get()->getRow('CARRINHO_DE_COMPRAS_ID');
        $builder->where('ID', $id_detalhes_pedido);
        $db->close();
        return $id_carrinho;
    }

    public function alteraStatusCarrinho($id_detalhes_pedido) {
        $id_carrinho = $this->getIdCarrinhoPorDetalhePedido($id_detalhes_pedido);
        $db = \Config\Database::connect();
        $builder = $db->table('carrinho_de_compras');
        $builder->set('STATUS_COMPRA', 'FECHADO');
        $builder->where('ID', $id_carrinho);
        $builder->update();
        $db->close();
    }

    public function getIdTransactionByIdDetahesPedido($id_detalhes_pedido) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('ID', $id_detalhes_pedido);
        $id_transaction = $builder->get()->getRow('ID_TRANSACTION');
        $db->close();
        return $id_transaction;
    }

    public function updatedDetalhesPedidoDadosPagamento($id_detalhes_pedido, $payment) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->set('ID_TRANSACTION', $payment['id_transaction']);
        $builder->set('QRCODE', $payment['qrcode']);
        $builder->set('QRCODE64', $payment['qrcode64']);
        $builder->where('ID', $id_detalhes_pedido);
        $builder->update();
        $db->close();
    }

    public function getDetalhesPedidoById($id_detalhes_pedido) {
        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('ID', $id_detalhes_pedido);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function verificaIdUsuarioEmDetalhesPedido($id_detalhes_pedido) {
        $user = new User();
        $id_usuario = $user->idUser();

        $db = \Config\Database::connect();
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('ID', $id_detalhes_pedido);
        $builder->where('USUARIO_ID', $id_usuario);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function getComprasUsuarioById($id_usuario) {
        $db = \Config\Database::connect();
        // $builder->select('

        // ');
        $builder = $db->table('detalhes_do_pedido');
        $builder->where('USUARIO_ID', $id_usuario);
        // $builder->join('carrinho_de_compras', 'detalhes_do_pedido.CARRINHO_DE_COMPRAS_ID = carrinho_de_compras.ID');
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

}