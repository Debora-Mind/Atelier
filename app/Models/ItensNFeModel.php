<?php

namespace App\Models;

use CodeIgniter\Model;

class ItensNFeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'itens_nfe';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nfe_temp_id', 'prod_cProd', 'prod_item', 'prod_pedido_id', 'prod_nNF', 'prod_indTot',
        'nfe_temp_serie', 'prod_cEAN', 'prod_xProd', 'prod_NCM', 'prod_CFOP', 'prod_uCom', 'prod_qCom', 'prod_vUnCom',
        'prod_vProd', 'prod_cEANTrib', 'prod_uTrib', 'prod_qTrib', 'prod_vUnTrib', 'icms_orig', 'icms_CST', 'icms_modBC',
        'icms_vBC', 'icms_pICMS', 'icms_vICMS', 'pis_CST', 'pis_vBC', 'pis_pPIS', 'pis_vPIS', 'cofins_CST', 'cofins_vBC',
        'cofins_pCOFINS', 'cofins_vCOFINS', 'produto_id', 'empresa_id'];

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

    public function getItensNFe($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }

    public function getItensNFeNota($idNfe)
    {
        return $this->asArray()
            ->where(['nfe_temp_id' => $idNfe])
            ->findAll();
    }
}
