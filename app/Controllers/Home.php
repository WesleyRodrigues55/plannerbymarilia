<?php

namespace App\Controllers;
use App\Controllers\Product;
use App\Controllers\Testimony;

class Home extends BaseController
{
    public function index(): string
    {
        $produto = new Product();
        $depoimento = new Testimony();
        
        $planners_data = $produto->plannersHome();
        $presentes_criativos_data = $produto->presentesCriativosHome();
        $mais_vendidos_data = $produto->maisVendidosHome();
        $depoimentos = $depoimento->depoimentosHome();

        $data = [
            'planners' => $planners_data,
            'presentes_criativos' => $presentes_criativos_data,
            'mais_vendidos' => $mais_vendidos_data,
            'depoimentos' => $depoimentos
        ];
        return view('home', $data);
    }

    public function politicaLoja() {
        return view('politicas/politica-loja');
  }

  public function politicaPrivacidade() {
    return view('politicas/politica-privacidade');
}

}
