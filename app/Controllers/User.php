<?php

namespace App\Controllers;
use App\Controllers\Testimony;
use App\Controllers\BuyCart;

use CodeIgniter\I18n\Time;
use Config\Services;

class User extends BaseController
{
    public function login()
    {
        return  view('/login/login');
    }
    public function novaSenha()
    {
        return  view('/login/nova-senha');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function cadastroUser()
    {
        return view('login/cadastrar');
    }



    //REALIZAR TRATATIVA DAS SENHAS IGUAIS NO JS -------------------------------------------------------------------------------
    public function cadastroUsuario()
    {
        //USER
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        $senha = password_hash("$senha", PASSWORD_BCRYPT);
        $confirmarSenha = $this->request->getPost('confirmarSenha');

        //PERSON
        $nome = $this->request->getPost('nome');
        $sobrenome = $this->request->getPost('sobrenome');
        $telefone_01 = $this->request->getPost('telefone_01');
        $telefone_02 = $this->request->getPost('telefone_02');
        $celular = $this->request->getPost('celular');
        $cep = $this->request->getPost('CEP');
        $rua = $this->request->getPost('rua');
        $numeroResidencia = $this->request->getPost('numeroResidencia');
        $complemento = $this->request->getPost('complemento');
        $bairro = $this->request->getPost('bairro');
        $cidade = $this->request->getPost('cidade');
        $estado = $this->request->getPost('estado');
        $termoPrivacidade = $this->request->getPost('termoPrivacidade');
        $tipoPessoa = $this->request->getPost('tipoPessoa');
        $termoPrivacidade = $termoPrivacidade == 'on' ? 1 : 0;

        if ($tipoPessoa == 'FISICA') {
            $cpf = $this->request->getPost('CPF');
            $data_nascimento = $this->request->getPost('dataNascimento');
            $cnpj = "";
            $inscricaoEstadual = "";
        } else {
            $cnpj = $this->request->getPost('CNPJ');
            $inscricaoEstadual = $this->request->getPost('inscricaoEstadual');
            $cpf = "";
            $data_nascimento = "";
        }


        $dataPessoa = [
            'NOME' => $nome,
            'SOBRENOME' => $sobrenome,
            'EMAIL' => $email,
            'DATA_NASCIMENTO' => $data_nascimento,
            'TELEFONE_01' => $telefone_01,
            'TELEFONE_02' => $telefone_02,
            'CELULAR' => $celular,
            'TIPO_PESSOA' => $tipoPessoa,
            'CPF' => $cpf,
            'CNPJ' => $cnpj,
            'INSCRICAO_ESTADUAL' => $inscricaoEstadual,
            'CEP' => $cep,
            'RUA' => $rua,
            'NUMERO' => $numeroResidencia,
            'COMPLEMENTO' => $complemento,
            'BAIRRO' => $bairro,
            'CIDADE' => $cidade,
            'ESTADO' => $estado,
            'POLITICA_PRIVACIDADE' => $termoPrivacidade,
        ];

        try {
            if ($cpf) {
                $db = \Config\Database::connect();
                $builder = $db->table('pessoa');
                if ($builder->where('CPF', $cpf)->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('cpf-exists', 'CPF já cadastrado, por favor, use outro.');
                    return redirect()->back();
                }
            }

            // Verificar se o e-mail já existe
            if ($email) {
                $db = \Config\Database::connect();
                $builder = $db->table('pessoa');
                if ($builder->where('EMAIL', $email)->countAllResults() > 0) {
                    $db->close();
                    session()->setFlashdata('email-exists', 'E-mail já cadastrado, por favor, use outro.');
                    return redirect()->back();
                }
            }

            $db = \Config\Database::connect();
            $builder = $db->table('pessoa');
            $builder->insert($dataPessoa);
            $ultimo_id_inserido = $db->insertID();
            $db->close();

            $dataUsuario = [
                'PESSOA_ID' => $ultimo_id_inserido,
                'USUARIO' => $email,
                'SENHA' => $senha,
                'RECUPERA_SENHA' => '',
                'FOTO_PERFIL' => 'profile.png',
                'EMAIL_RECUPERACAO' => $email,
                'HASH_SENHA' => '',
                'ATIVO' => 1,
                'LEMBRAR_DE_MIM' => 1,
                'NIVEL' => 1,
            ];

            $db = \Config\Database::connect();
            $builder = $db->table('usuario');
            $builder->insert($dataUsuario);


            $db->close();
            session()->setFlashdata('success-register', 'Conta criada com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {

            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function verificarLogin()
    {
        $usuario = $this->request->getPost()['EMAIL'];
        $senha = $this->request->getPost()['SENHA'];

        // Consulta SQL personalizada
        $db = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('
            usuario.ID, 
            usuario.PESSOA_ID, 
            usuario.SENHA, 
            usuario.USUARIO, 
            usuario.ATIVO, 
            usuario.NIVEL, 
            pessoa.NOME, 
            pessoa.CELULAR
        ');
        $builder->join('pessoa', 'pessoa.ID = usuario.PESSOA_ID');
        $builder->where('usuario.USUARIO', $usuario);
        $builder->where('usuario.ATIVO', 1);

        $result = $builder->get()->getRow();

        if ($result && password_verify($senha, $result->SENHA)) {
            session()->set([
                'id' => $result->ID,
                'nome' => $result->NOME,
                'celular' => $result->CELULAR,
                'usuario' => $result->USUARIO,
                'pessoa_id' => $result->PESSOA_ID,
                'nivel' => $result->NIVEL,
                'ativo' => $result->ATIVO,
            ]);

            // Redireciona com base no nível
            if (session()->get('nivel') == 1) {
                return redirect()->to('../');
            } elseif (session()->get('nivel') == 2) {
                return redirect()->to('administrador/dashboard');
            }
        } else {
            session()->setFlashdata('login-failed', 'Credenciais incorretas!');
            return redirect()->back();
        }
    }


    public function idUser()
    {
        return session()->get('id');
    }

    public function esqueceuSenha()
    {
        return view('login/esqueci-senha');
    }

    public function confirmacaoSenha()
    {
        $destinatario = $this->request->getPost('EMAIL');

        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, PESSOA_ID, USUARIO, ATIVO, NIVEL');
        $builder->where('USUARIO', $destinatario);
        $query = $builder->get()->getResultArray();

        // echo "<pre>";
        // var_dump($query);

        if ($query == false) {
            //CORRIGIRRRRRRRRR
            // return redirect()->to('login/esqueceu-senha');
        } else {

            // echo '<pre>';
            // var_dump($query);
            $usuarioModel = new \App\Models\User();

            $token = bin2hex(random_bytes(32)); // Gere um token único
            $usuarioModel->update($query[0]['ID'], [
                'RECUPERA_SENHA' => $token
            ]);


            $resetLink = site_url("reset-senha?token=$token");

            $config['mailType']       = 'html';

            $email = \Config\Services::email();
            $email->initialize($config);
            $email->setFrom('plannerbymarilia@gmail.com');
            $email->setTo('lucassuzuki13@gmail.com');
            $email->setSubject('Recuperação de Senha - Planner By Marilia');
            $email->setMessage("Para redefinir sua senha, clique no link a seguir:\n$resetLink");

            $email->send();

            echo '<pre>';
            var_dump($email->send());
            if ($email->send()) {
                return redirect()->to('login/esqueceu-senha')->with('mensagem', 'Um e-mail de recuperação foi enviado para o seu endereço de e-mail.');
            } else {
                return redirect()->to('login/esqueceu-senha?error');
            }
        }
    }

    public function meusDepoimentos()
    {
        $user = new User();
        if (!$user->validaLogin())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('perfil-usuario/meus-depoimentos');
    }

    public function validaLogin()
    {
        return session()->has('usuario');
    }

    public function validaLoginAdm()
    {
        return session()->has('usuario') && session()->get('nivel') == 2 ? true : false;
    }

    public function getPessoaByIdUsuario($id_usuario)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->where('ID', $id_usuario);
        $id_pessoa = $builder->get()->getRow('PESSOA_ID');
        $db->close();

        return $id_pessoa;
    }

    public function getPessoa($id_usuario)
    {
        $id_pessoa = $this->getPessoaByIdUsuario($id_usuario);
        $db      = \Config\Database::connect();
        $builder = $db->table('pessoa');
        $builder->where('ID', $id_pessoa);
        $query = $builder->get()->getResultArray();
        $db->close();

        return $query;
    }

    public function perfilUsuario()
    {
        $user = new User();
        $buy_cart = new BuyCart();
        $testimony = new Testimony();

        if (!$user->validaLogin()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $id_usuario = session()->get('id');

        $usuario_selecionado = $user->getPessoa($id_usuario);
        $depoimentos_usuario = $testimony->getDepoimentosPorIdUsuario($id_usuario);
        $compras_usuario = $buy_cart->getComprasUsuarioById($id_usuario);

        if ($usuario_selecionado !== null) {
            $data = [
                "usuario_selecionado" => $usuario_selecionado[0],
                "depoimentos_usuario" => $depoimentos_usuario,
                "compras_usuario" => $compras_usuario
            ];

            return view('perfil-usuario/perfil', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function alterarPessoa()
    {
        $user = new User();
        if (!$user->validaLogin()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $id_usuario = session()->get('id_usuario');

        $id_pessoa = $this->request->getPost('id-pessoa');
        $nome = $this->request->getPost('nome');
        $sobrenome = $this->request->getPost('sobrenome');
        $cep = $this->request->getPost('cep');
        $rua = $this->request->getPost('rua');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');
        $bairro = $this->request->getPost('bairro');
        $cidade = $this->request->getPost('cidade');
        $estado = $this->request->getPost('estado');
        $telefone_01 = $this->request->getPost('telefone_01');
        $celular = $this->request->getPost('celular');

        $data = [
            'NOME' => $nome,
            'SOBRENOME' => $sobrenome,
            'CEP' => $cep,
            'RUA' => $rua,
            'NUMERO' => $numero,
            'COMPLEMENTO' => $complemento,
            'BAIRRO' => $bairro,
            'CIDADE' => $cidade,
            'ESTADO' => $estado,
            'TELEFONE_01' => $telefone_01,
            'CELULAR' => $celular,
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('pessoa');
            $builder->where('ID', $id_pessoa);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Alteração falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Alteração completa.'
                );
            }
            echo json_encode($response);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function AlterarUsuarioLogado()
    {
        $user = new User();
        if (!$user->validaLogin()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $usuario = $this->request->getPost('usuario');
        $id_usuario = $this->request->getPost('id');
        $senha = $this->request->getPost('senha');
        $senha = password_hash("$senha", PASSWORD_BCRYPT);

        $data = [
            'SENHA' => $senha,
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('usuario');
            $builder->where('ID', $id_usuario);
            $builder->update($data);
            $db->close();

            if (!$builder) {
                $response = array(
                    'success' => true,
                    'message' => 'Alteração falhou.'
                );
            } else {
                $response = array(
                    'success' => true,
                    'message' => 'Alteração completa.'
                );
            }
            echo json_encode($response);
        } catch (\Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function desativaDepoimento() {
        $id_depoimento = $this->request->getPost('id-depoimento');
        $item_tab = $this->request->getPost('item-tab');
        $data = [ 'ATIVO' => 0 ];

        $db = \Config\Database::connect();
        $builder = $db->table('depoimentos');
        $builder->where('ID', $id_depoimento);
        $builder->update($data);
        $db->close();

        if (!$builder) {
            //mensagem de removido com session
            session()->setFlashdata('query-depoimentos-failed', 'Error ao desativar depoimento.');
        } else {
            //mensagem de removido com session
            session()->setFlashdata('query-depoimentos-success', 'Depoimento desativado com sucesso!');
        }
        
        return redirect()->to('perfil/perfil-usuario#'.$item_tab);
    }
}
