<?php

namespace App\Controllers;
use App\Controllers\User;
use CodeIgniter\I18n\Time;

class DeliveryAdress extends BaseController
{

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

    public function getEnderecoUsuarioChecked($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function verificaEnderecoDeEntrega($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function cadastroEnderecoEntrega($id_carrinho, $id_usuario) {
        $user = new User();
        
        if (!$user->validaLogin() || !$user->validaLogin() && $id_carrinho == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

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

}