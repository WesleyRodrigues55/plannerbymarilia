<?php

namespace App\Controllers;


class User extends BaseController
{
    //============================================================================
    # INICIAR LOGIN
    public function login()
    {
        return
            view('/login/login');
    }

    //============================================================================
    # LOGOUT
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    //============================================================================
    #SESSÃO DE LOGIN
    public function recebeDadosLogin()
    {
        //recebe dados do formulário
        $this->usuario = $this->request->getPost()['EMAIL'];
        $this->senha = $this->request->getPost()['SENHA'];
    }

    public function verificarLogin()
    {
        $this->recebeDadosLogin();

        //consulta sql personalizada
        $db      = \Config\Database::connect();
        $builder = $db->table('usuario');
        $builder->select('ID, PESSOA_ID, USUARIO, ATIVO, NIVEL');
        $builder->where('USUARIO', $this->usuario);
        $builder->where('SENHA', $this->senha);
        $builder->where('ATIVO', 1);
        $query = $builder->get()->getResultArray();

        if ($query == false) {
            return redirect()->to('usuario/login?error'); //pesquisar sobre erro   --------------------------------------------------------
        } else {
            session()->set([
            'id' => $query[0]['ID'],
            'usuario' => $query[0]['USUARIO'],
            'pessoa_id' => $query[0]['PESSOA_ID'],
            'nivel' => $query[0]['NIVEL'],
            'ativo' => $query[0]['ATIVO'],
        ]);
        }
        
        // Redireciona com base no nível
        if (session()->get('nivel') == 1) {
            return redirect()->to('../');
        } elseif (session()->get('nivel') == 2) {
            return redirect()->to('pagina-de-administrador');
        }
        // print_r(session()->get());
    

    }



    public function esqueceuSenha(): string
    {
        return view('login/esqueci-senha');

    }
}
