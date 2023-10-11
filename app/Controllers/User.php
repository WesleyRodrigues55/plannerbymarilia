<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login(): string
    {
        return view('login/login');
    }
}
