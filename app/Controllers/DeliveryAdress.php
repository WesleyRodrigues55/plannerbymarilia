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

    public function getEnderecoUsuarioById($id_endereco) {
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
        $builder->where('endereco_de_entrega.ID', $id_endereco);
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
        } else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            if (!$this->getEnderecoUsuario($id_usuario)) {
                return $this->enderecoDeEntrega($id_carrinho, $id_usuario);
            }
            
            $data = [
                'dados_usuario' => $this->getEnderecoUsuario($id_usuario),
                'id_carrinho' => $id_carrinho
            ];

            return view('comprando/endereco-de-entrega/escolhendo-endereco-de-entrega', $data);
        }
    }

    public function editarEnderecoEntrega($id_endereco, $id_usuario, $id_carrinho) {
        $user = new User();

        if (!$user->validaLogin()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        else if ($user->idUser() != $id_usuario) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        } else {
            $data = [
                'dados_usuario' => $this->getEnderecoUsuarioById($id_endereco),
                'id_carrinho' => $id_carrinho
            ];
            return view('comprando/endereco-de-entrega/editando-endereco-de-entrega', $data);
        }
        
    }

    public function editandoEnderecoDeEntrega() {
        echo "<pre>";
        var_dump($this->request->getPost());
        
        $id_endereco = $this->request->getPost('id-endereco');
        $id_carrinho = $this->request->getPost('id-carrinho');
        $id_usuario = $this->request->getPost('id-usuario');
        $nome_completo = $this->request->getPost('nome');
        $celular = $this->request->getPost('celular');
        $cep = $this->request->getPost('cep');
        $rua = $this->request->getPost('rua');
        $cidade = $this->request->getPost('cidade');
        $estado = $this->request->getPost('estado');
        $local_entrega = $this->request->getPost('local');
        $informacoes_adicionais = $this->request->getPost('informacoes');
        $bairro = $this->request->getPost('bairro');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');

        $data = [
            'USUARIO_ID' => $id_usuario,
            'NOME_COMPLETO' => $nome_completo,
            'CELULAR' => $celular,
            'CEP' => $cep,
            'RUA' => $rua,
            'CIDADE' => $cidade,
            'ESTADO' => $estado,
            'LOCAL_ENTREGA' => $local_entrega,
            'INFORMACOES_ADICIONAIS' => $informacoes_adicionais,
            'BAIRRO' => $bairro,
            'NUMERO' => $numero,
            'COMPLEMENTO' => $complemento
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('ID', $id_endereco);
        $builder->update($data);
        $db->close();

        if (!$builder) {
            session()->setFlashdata('endereco-failed', 'Tivemos um erro em editar seu endereço, por favor tente novamente!');
        } else {
            session()->setFlashdata('endereco-success', 'Endereço editado com sucesso!');
        }

        session()->set([
            'id_carrinho' => $id_carrinho
        ]);    

        return redirect()->back();

    }   

    public function getEnderecoUsuarioChecked($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

    public function verificaEnderecoDeEntrega($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('CHECKED', 1);
        $query = $builder->get()->getResultArray();
        $db->close();
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

    public function validaEnderecoExistente($id_usuario, $rua, $cidade, $numero) {
        $db = \Config\Database::connect();
        $builder = $db->table('endereco_de_entrega');
        $builder->where('USUARIO_ID', $id_usuario);
        $builder->where('RUA', $rua);
        $builder->where('CIDADE', $cidade);
        $builder->where('NUMERO', $numero);
        $query = $builder->get()->getResultArray();
        $db->close();

        return $query;
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

        if ($this->validaEnderecoExistente($id_usuario, $rua, $cidade, $numero) != null) {
            session()->setFlashdata('endereco-exists', 'Esse endereço já existe cadastrado, edite-o ou adicione um diferente!');
            return redirect()->back();
        }
        
        $this->updatedRemoveCheckedEnderecoEntrega($id_usuario);
    
        try {
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

            $db = \Config\Database::connect();
            $builder = $db->table('endereco_de_entrega');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('endereco-failed', 'Tivemos um erro em salvar seu endereço, por favor tente novamente!');
            } else {
                session()->setFlashdata('endereco-success', 'Endereço salvo com sucesso!');
            }

            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

}