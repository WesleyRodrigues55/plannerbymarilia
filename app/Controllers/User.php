<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login(): string
    {
        return view('login/login');
    }

    public function esqueceuSenha(): string
    {
        return view('login/esqueci-senha');
    }
}
