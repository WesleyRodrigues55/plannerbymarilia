<?php

namespace App\Controllers;
use App\Controllers\User;

use CodeIgniter\I18n\Time;
use Config\Services;

class Testimony extends BaseController
{
    public function depoimentosClientes() {
        $user = new User();
        if (!$user->validaLogin())
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
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
        $myTime = Time::now('America/Sao_Paulo');

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
            'ID_USUARIO' => $id,
            'CREATED_AT' => $myTime->toDateTimeString(),
            'ATIVO' => 1
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

    public function getDepoimentosPorIdUsuario($id_usuario) {
        $db = \Config\Database::connect();
        $builder = $db->table('depoimentos');
        $builder->select('
            ID,
            NOME,
            EMAIL,
            TELEFONE,
            INSTAGRAM,
            DEPOIMENTO,
            ID_USUARIO,
            DATE_FORMAT(CREATED_AT, "%d/%m/%Y") as data_formatada,
            DATE_FORMAT(CREATED_AT, "%H:%i:%s") as hora_formatada
        ');
        $builder->where('ID_USUARIO', $id_usuario);
        $builder->where('ATIVO', 1);
        $query = $builder->get()->getResultArray();
        $db->close();
        return $query;
    }

}