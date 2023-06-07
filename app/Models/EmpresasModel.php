<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'empresas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['razao_social', 'nome_fantasia', 'cnpj', 'ie', 'im', 'logradouro', 'numero', 'emitentexCpl',
        'bairro', 'fone', 'cep', 'pais', 'municipio', 'codPais', 'codMun', 'uf', 'CST_CSOSN_padrao', 'CST_COFINS_padrao',
        'CST_PIS_padrao', 'CST_IPI_padrao', 'frete_padrao', 'tipo_pagamento_padrao', 'nat_op_padrao', 'CNAE', 'CRT_ID',
        'ambiente', 'cUF', 'numero_serie_nfe', 'numero_serie_nfce', 'ultimo_numero_nfe', 'ultimo_numero_nfce', 'ultimo_numero_cte',
        'ultimo_numero_mdfe', 'csc', 'csc_id', 'tokenIBPT', 'certificado_a3', 'ibge', 'senha_centificado', 'replyName',
        'host', 'user', 'password', 'secure', 'port', 'fantasy', 'replyTo', 'logomarca', 'system_unit_id', 'path_site',
        'url_dominio', 'validade_certificado', 'situacao_cnpj', 'cfop_padrao', 'ambiante_nfe', 'ativo', 'tema', 'logo',
        'configuracoes'];

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

    public function getEmpresas($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }
}
