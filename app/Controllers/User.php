<?php

namespace App\Controllers;


class User extends BaseController
{
    public function login(): string
    {
        return view('login/login');
    }

    public function autenticar()
    {
        $dados = $this->request->getVar();

        $url = base_url('');

        $user_model = new User_model();

        $login = $user_model
            ->where('EMAIL', $dados['EMAIL'])
            ->where('SENHA', $dados['SENHA'])
            ->first();

        // if (!empty($login)) {
        //     return redirect()->to($url);
        // } else {
        //     return redirect()->to('login');
        // }
    }
}
