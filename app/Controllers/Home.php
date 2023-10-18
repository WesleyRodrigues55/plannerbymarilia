<?php

namespace App\Controllers;
use App\Controllers\Product;

class Home extends BaseController
{
    public function index(): string
    {
        $produto = new Product();
        $planners_data = $produto->plannersHome();
        $presentes_criativos_data = $produto->presentesCriativosHome();
        $mais_vendidos_data = $produto->maisVendidosHome();

        $data = [
            'planners' => $planners_data,
            'presentes_criativos' => $presentes_criativos_data,
            'mais_vendidos' => $mais_vendidos_data
        ];
        return view('home', $data);
    }
}
