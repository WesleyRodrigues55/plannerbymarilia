<?php

namespace App\Controllers;
use Config\Services;

class User extends BaseController
{
    public function login()
    {
        return  view('/login/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function cadastroUser(){
        return view('login/cadastrar');
    }

    public function verificarLogin()
    {
        $usuario = $this->request->getPost()['EMAIL'];
        $senha = $this->request->getPost()['SENHA'];

        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, PESSOA_ID, USUARIO, ATIVO, NIVEL');
        $builder->where('USUARIO', $usuario);
        $builder->where('SENHA', $senha);
        $builder->where('ATIVO', 1);
        $query = $builder->get()->getResultArray();

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
            return redirect()->to('pagina-de-administrador');
        }
    }

    public function idUser() {
        return session()->get('id');
    }

    public function esqueceuSenha(){
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

    public function meusDepoimentos() {
        return view('perfil-usuario/meus-depoimentos');
    }

    public function validaLogin(){
        return session()->has('usuario');
        
    }

}
