<?php

namespace App\Controllers;
use App\Controllers\User;

class Testimony extends BaseController
{
    public function depoimentosClientes() {
        return view('depoimentos/depoimentos');
    }

    public function depoimentosHome() {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('depoimentos');
            $query = $builder->get()->getResultArray();
            $db->close();

            if (!$query) {
                session()->setFlashdata('query-depoimentos-failed', 'Error ao filtrar dados.');
            }
            return $query;
        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

    public function salvar() {
        $user = new User();

        $id = $user->idUser();
        $nome = $this->request->getPost('nome');
        $email = $this->request->getPost('email');
        $telefone = $this->request->getPost('telefone');
        $instagram = $this->request->getPost('instagram');
        $mensagem = $this->request->getPost('mensagem');

        $data = [
            'NOME' => $nome,
            'EMAIL' => $email,
            'TELEFONE' => $telefone,
            'INSTAGRAM' => $instagram,
            'DEPOIMENTO' => $mensagem,
            'ID_USUARIO' => $id
        ];

        try {
            $db = \Config\Database::connect();
            $builder = $db->table('depoimentos');
            $builder->insert($data);
            $db->close();

            if (!$builder) {
                session()->setFlashdata('depoimento-failed', 'Tivemos um erro em salvar seu depoimento, por favor tente novamente!');
            } else {
                session()->setFlashdata('depoimento-success', 'depoimento salvo com sucesso!');
            }
            return redirect()->back();

        } catch (\Exception $e) {
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
        } 
    }

}