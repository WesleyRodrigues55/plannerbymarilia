<?php

namespace App\Controllers;
use App\Controllers\User;
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
                produto.PRECO,
                estoque.QUANTIDADE as QUANTIDADE_ESTOQUE
            ');
            $builder->where('CARRINHO_DE_COMPRA_ID', $carrinho_de_compra_id);
            $builder->join('produto', 'produto.ID = itens_carrinho.PRODUTO_ID');
            $builder->join('estoque', 'estoque.PRODUTO_ID = produto.ID');
            $query = $builder->get()->getResultArray();
            $db->close();

            // echo "<pre>";
            // var_dump($query);
            return $query;
            // return view("carrinho/itens-carrinho", $data);
        } else {
            
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

    public function updatedQuantidadeEstoque() {

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
        $this->removeQuantidadeEstoque($id_produto);
        
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
        $builder->set('QUANTIDADE',$quantidade -1);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->update();
    }

    public function retornaQuantidadeEstoque($id_produto) {
        $db = \Config\Database::connect();
        $builder = $db->table('estoque');
        $builder->where('PRODUTO_ID', $id_produto);
        $quantidade = $builder->get()->getRow('QUANTIDADE');
        $builder->set('QUANTIDADE',$quantidade + 1);
        $builder->where('PRODUTO_ID', $id_produto);
        $builder->update();
    }

    public function inserePrimeiroItemNoCarrinho($ultimo_id_novo_carrinho_inserido, $id_produto, $preco_produto) {
        $this->removeQuantidadeEstoque($id_produto);
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

        $response = array(
            'success' => true,
            'message' => 'Adição bem-sucedida.'
        );
    
        echo json_encode($response);
    }

    public function insereItemNoCarrinho($id_carrinho_compra, $id_produto, $preco_produto) {
        $this->removeQuantidadeEstoque($id_produto);
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
            // session()->setFlashdata('query-success', 'Quantidade alterada.');
            $response = array(
                'success' => true,
                'message' => 'Remoção bem-sucedida.'
            );
        
            echo json_encode($response);
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

    public function getEnderecoUsuario($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->select('
            endereco_de_entrega.ID,
            endereco_de_entrega.USUARIO_ID,
            endereco_de_entrega.CEP,
            endereco_de_entrega.RUA,
            endereco_de_entrega.CIDADE,
            endereco_de_entrega.ESTADO,
            endereco_de_entrega.LOCAL_ENTREGA,
            endereco_de_entrega.INFORMACOES_ADICIONAIS,
            endereco_de_entrega.BAIRRO,
            endereco_de_entrega.NUMERO,
            endereco_de_entrega.COMPLEMENTO,
            endereco_de_entrega.RUA,
            endereco_de_entrega.CHECKED,
            endereco_de_entrega.NOME_COMPLETO,
            endereco_de_entrega.CELULAR
        ');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->join('usuario', 'usuario.ID = endereco_de_entrega.USUARIO_ID');
        $builder->orderBy('CHECKED', 'DESC');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getEnderecoUsuarioChecked($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function escolherEnderecoEntrega($id_carrinho, $id_usuario) {
        $user = new User();
        
        if (!$user->validaLogin() || !$user->validaLogin() && $id_carrinho == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {

            if (!$this->getEnderecoUsuario($id_usuario)) {
                return $this->enderecoDeEntrega($id_carrinho, $id_usuario);
            }
            
            $data = [
                'dados_usuario' => $this->getEnderecoUsuario($id_usuario),
                'id_carrinho' => $id_carrinho
            ];
            session()->set([
                'id_carrinho' => $id_carrinho
            ]);    
            return view('comprando/endereco-de-entrega/escolhendo-endereco-de-entrega', $data);
        }
    }

    public function verificaEnderecoDeEntrega($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        return $query;
    }
    
    public function enderecoDeEntrega($id_carrinho, $id_usuario) {
        $user = new User();
        
        if (!$user->validaLogin() || !$user->validaLogin() && $id_carrinho == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'dados_usuario' => $this->getEnderecoUsuarioChecked($id_usuario),
            'id_carrinho' => $id_carrinho
        ];

        // var_dump($this->getEnderecoUsuarioChecked($id_usuario));
        return view('comprando/endereco-de-entrega/endereco', $data);
    }

    public function cadastroEnderecoEntrega($id_carrinho, $id_usuario) {
        $user = new User();
        
        if (!$user->validaLogin() || !$user->validaLogin() && $id_carrinho == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // session()->set([
        //     'id_carrinho' => $id_carrinho
        // ]);

        $data = [
            'id_usuario' => $id_usuario,
            'id_carrinho' => $id_carrinho
        ];

        return view('comprando/endereco-de-entrega/cadastro', $data);
    }

    public function updatedRemoveCheckedEnderecoEntrega($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->set('CHECKED', 0);
        $builder->where('CHECKED', 1);
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->update();
        $db->close();
    }

    public function addCheckedEnderecoEntrega($id_endereco_escolhido, $id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->set('CHECKED', 1);
        $builder->where('ID', $id_endereco_escolhido);
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->update();
        $db->close();
    }

    public function cadastrarEnderecoEntrega() {
        $id_usuario = $this->request->getPost('id-usuario');
        $id_carinho_compras = $this->request->getPost('id-carrinho-compras');
        $nome = $this->request->getPost('nome');
        $celular = $this->request->getPost('celular');
        $cep = $this->request->getPost('cep');
        $rua = $this->request->getPost('rua');
        $cidade = $this->request->getPost('cidade');
        $bairro = $this->request->getPost('bairro');
        $estado = $this->request->getPost('estado');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');
        $local = $this->request->getPost('local');
        $informacoes = $this->request->getPost('informacoes');


        // $db = \Config\Database::connect();
        // $builder = $db->table('endereco_de_entrega');
        // $builder->set('CHECKED', 0);
        // $builder->where('CHECKED', 1);
        // $builder->where('USUARIO_ID', $id_usuario);
        // $builder->update();
        // $db->close();
        $this->updatedRemoveCheckedEnderecoEntrega($id_usuario);
        

        $data = [
            'USUARIO_ID' => $id_usuario,
            'NOME_COMPLETO' => $nome,
            'CELULAR' => $celular,
            'CEP' => $cep,
            'RUA' => $rua,
            'CIDADE' => $cidade,
            'ESTADO' => $estado,
            'LOCAL_ENTREGA' => $local,
            'INFORMACOES_ADICIONAIS' => $informacoes,
            'BAIRRO' => $bairro,
            'NUMERO' => $numero,
            'COMPLEMENTO' => $complemento,
            'CHECKED' => 1,
            'ATIVO' => 1
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('endereco_de_entrega');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('endereco-failed', 'Tivemos um erro em salvar seu endereço, por favor tente novamente!');
            } else {
                session()->setFlashdata('endereco-success', 'Endereço salvo com sucesso!');
            }

            $data = [
                'dados_usuario' => $this->getEnderecoUsuario($id_usuario),
                'id_carrinho' => $id_carinho_compras
            ];

            return redirect()->back();

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
        $myTime = Time::now('America/Sao_Paulo');

        $id_carrinho = $this->request->getPost('id-carrinho');
        $id_endereco_escolhido = $this->request->getPost('id-endereco-escolhido');
        $id_usuario = $this->request->getPost('id-usuario');

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
        
        $this->updatedRemoveCheckedEnderecoEntrega($id_usuario);
        $this->addCheckedEnderecoEntrega($id_endereco_escolhido, $id_usuario);

        if ($this->getDetalhesPedido($id_carrinho, $id_usuario)) {
            // $data = [
            //     'CARRINHO_DE_COMPRAS_ID' => $id_carrinho,
            //     'ENDERECO_DE_ENTREGA_ID' => $id_endereco_escolhido,
            //     'USUARIO_ID' => $id_usuario,
            //     'DATA_PEDIDO' => $myTime->toDateTimeString(),
            //     'STATUS_PEDIDO' => 'EM ABERTO',
            //     'TOTAL_PEDIDO' => $subtotal
            // ];

            $db = \Config\Database::connect();
            $builder = $db->table('detalhes_do_pedido');
            $builder->set('DATA_PEDIDO', $myTime->toDateTimeString());
            $builder->set('TOTAL_PEDIDO', $subtotal);
            $builder->where('CARRINHO_DE_COMPRAS_ID', $id_carrinho);
            $builder->where('ENDERECO_DE_ENTREGA_ID', $id_endereco_escolhido);
            $builder->where('USUARIO_ID', $id_usuario);
            $builder->update();
            $db->close();
        } else {
            $data = [
                'CARRINHO_DE_COMPRAS_ID' => $id_carrinho,
                'ENDERECO_DE_ENTREGA_ID' => $id_endereco_escolhido,
                'USUARIO_ID' => $id_usuario,
                'DATA_PEDIDO' => $myTime->toDateTimeString(),
                'STATUS_PEDIDO' => 'EM ABERTO',
                'TOTAL_PEDIDO' => $subtotal
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('detalhes_do_pedido');
            $builder->insert($data);
            $db->close();
        }

        return view('comprando/forma-de-pagamento/escolhendo-forma-de-pagamento');
    }

}