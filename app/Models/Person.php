<?php

namespace App\Models;

use CodeIgniter\Model;

class Person extends Model
{
    protected $table = 'pessoa';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'ID',
        'NOME',        
        'SOBRENOME',
        'EMAIL',
        'DATA_NASCIMENTO',
        'TELEFONE_01',
        'TELEFONE_02',
        'CELULAR',
        'TIPO_PESSOA',
        'CPF',
        'CNPJ',
        'INSCRICAO_ESTADUAL',
        'CEP',
        'RUA',
        'NUMERO',
        'COMPLEMENTO',
        'BAIRRO',
        'CIDADE',
        'ESTADO',
        'POLITICA_PRIVACIDADE',
    ];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}