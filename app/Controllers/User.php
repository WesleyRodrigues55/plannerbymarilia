<?php

namespace App\Controllers;

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

            $builder = $db->table('usuario');
            $builder->insert($dataUsuario);

            $db->close();
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        }
    }

    public function verificarLogin()
    {
        $usuario = $this->request->getPost()['EMAIL'];
        $senha = $this->request->getPost()['SENHA'];


        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, PESSOA_ID, SENHA, USUARIO, ATIVO, NIVEL');
        $builder->where('USUARIO', $usuario);
        $builder->where('ATIVO', 1);
        $getSenha = $builder->get()->getRow()->SENHA;
        if (password_verify($senha, $getSenha)) {
            $builder->where('USUARIO', $usuario);
            $builder->where('ATIVO', 1);
            $query = $builder->get()->getResultArray();
        } else {
            session()->setFlashdata('login-failed', 'Credencias incorretas!');
            return redirect()->back();
        }

        if (!$query) {
            session()->setFlashdata('login-failed', 'Credencias incorretas!');
            return redirect()->back();
        }

        session()->set([
            'id' => $query[0]['ID'],
            'usuario' => $query[0]['USUARIO'],
            'pessoa_id' => $query[0]['PESSOA_ID'],
            'nivel' => $query[0]['NIVEL'],
            'ativo' => $query[0]['ATIVO'],
        ]);

        // Redireciona com base no nível
        if (session()->get('nivel') == 1) {
            return redirect()->to('../');
        } elseif (session()->get('nivel') == 2) {
            return redirect()->to('administrador/dashboard');
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
            return redirect()->to('login/esqueceu-senha?error'); // Redirecione com uma mensagem de erro
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
        return view('perfil-usuario/meus-depoimentos');
    }
    public function perfilUsuario()
    {
        return view('perfil-usuario/perfil');
    }

    public function validaLogin()
    {
        return session()->has('usuario');
    }

    public function validaLoginAdm()
    {
        return session()->has('usuario') && session()->get('nivel') == 2 ? true : false;
    }
}
