<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['empresa_id', 'cliente_id', 'valor', 'cProd', 'cEAN', 'cEANTrib', 'xProd', 'cod_fabrica',
        'uCom_Entrada', 'uCom_Saida', 'uTrib', 'qTrib', 'vUnTrib', 'tp_produto', 'vender_sem_estoque', 'prod_balanca',
        'tp_item', 'grupo', 'sub_grupo', 'departamento', 'classe', 'valor_entrada', 'valor_saida', 'margem_lucro_bruto',
        'vUnCom', 'NCM', 'CEST', 'CFOP_Saida', 'CFOP_Entrada', 'tPIS_cst', 'tPIS_tpcalc', 'tPIS_aliq', 'tCOFINS_cst',
        'tCOFINS_tpcalc', 'tCOFINS_aliq', 'tIPI_cst', 'tIPI_tpcalc', 'tIPI_aliq', 'tICMS_cst_A', 'tICMS_cst',
        'tICMS_tpcalc', 'tICMS_aliq', 'tICMS_origem', 'tICMS_mva', 'tICMS_beneficio', 'img', 'pdf'];

    // Dates
    protected $useTimestamps = true;
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

    public function getProdutos($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }
}
