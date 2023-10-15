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
        return redirect()->to('/login/login');
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
        $builder->select('ID, PESSOA_ID, USUARIO, SENHA, ATIVO, NIVEL');
        $builder->where('USUARIO', $this->usuario);
        $builder->where('SENHA', $this->senha);
        $builder->where('ATIVO', 1);
        $query = $builder->get()->getResultArray();

        //verifica como que está a estrutura do select
        // var_dump($builder->getCompiledSelect());

        if ($query == false) {
            return redirect()->to('usuario/login?error');
        } else {
            $nivel = $query[0]['NIVEL'];
        session()->set([
            'id' => $query[0]['ID'],
            'usuario' => $query[0]['USUARIO'],
            'pessoa_id' => $query[0]['PESSOA_ID'],
            'nivel' => $nivel,
            'ativo' => $query[0]['ATIVO'],
        ]);
        }

        // Redireciona com base no nível
        if ($nivel == 1) {
            return redirect()->to('../');
        } elseif ($nivel == 2) {
            return redirect()->to('pagina-de-administrador');
        }
        // print_r(session()->get());
    

    }



    public function esqueceuSenha(): string
    {
        return view('login/esqueci-senha');

    }
}
