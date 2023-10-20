<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table      = 'produto';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'ID',
        'NOME',
        'IMAGEM',
        'PRECO',
        'TIPO_CAPA',
        'CATEGORIA',
        'DESCRICAO_ELASTICO',
        'ENCADERNACAO',
        'TAMANHO_CAPA_SEM_DIVISORIA',
        'TAMANHO_CAPA_COM_DIVISORIA',
        'TAMANHO_INTERNO',
        'QUANTIDADE_FOLHA',
        'DESCRICAO_TECNICA',
        'DELETED_AT',
        'UPDATED_AT',
        'CREATED_AT',
        'ATIVO'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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