<?php

namespace App\Models;

use CodeIgniter\Model;

class NFeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nfe_temp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['status_id', 'nSeqEvento', 'empresa_id', 'cliente_id', 'numero_nfe', 'ide_serie',
        'ide_mod', 'pedidos_id', 'core_categoria_cfop_id', 'core_cfop_id', 'nfe_recibo', 'nfe_prot', 'dhRecbto', 'nProt',
        'digVal', 'cStat', 'xMotivo', 'dhRegEvento', 'xJust', 'xEvento', 'ide_Id', 'ide_versao', 'ide_chave_nfe',
        'ide_nome_xml', 'ide_rota_geracao', 'ide_cnpj_emitente', 'ide_status', 'ide_cUF', 'ide_cNF', 'ide_natOp',
        'ide_nNF', 'ide_dhEmi', 'ide_tpNF', 'ide_idDest', 'ide_cMunFG', 'ide_tpImp', 'ide_tpEmis', 'ide_cDV', 'ide_tpAmb',
        'ide_finNFe', 'ide_indFinal', 'ide_indPres', 'ide_procEmi', 'ide_verProc', 'emit_CNPJ', 'emit_xNome', 'emit_xFant',
        'emit_enderEmit', 'emit_xLgr', 'emit_nro', 'emit_xCpl', 'emit_xBairro', 'emit_cMun', 'emit_xMun', 'emit_UF',
        'emit_CEP', 'emit_cPais', 'emit_xPais', 'emit_fone', 'emit_IE', 'emit_CRT', 'emit_indIEDest', 'emit_email',
        'emit_CPF', 'tot_vBC', 'tot_vICMS', 'tot_vICMSDeson', 'tot_vFCP', 'tot_vBCST', 'tot_vST', 'tot_vFCPST', 'tot_vFCPSTRet',
        'tot_vProd', 'tot_vFrete', 'tot_vSeg', 'tot_vDesc', 'tot_vII', 'tot_vIPI', 'tot_vIPIDevol', 'tot_vPIS', 'tot_vCOFINS',
        'tot_vOutro', 'tot_vNF', 'tot_vTotTrib', 'fret_modFrete', 'fat_nFat', 'fat_vOrig', 'fat_vDesc', 'fat_vLiq', 'dup_nDup',
        'dup_dVenc', 'dup_vDup', 'detPag_tPag', 'detPag_vPag', 'detPag_vTroco', 'infAd_Fisco', 'inf_Cpl', 'pedido_id',
        'verAplic', 'chNFe', 'data_cancelamento', 'tpEvento', 'xCorrecao', 'path_xml', 'parh_file', 'hora_saida', 'data_saida',
        'finNFe', 'data_processamento', 'nRec', 'cUF', 'acronym', 'motive', 'timestamp', 'type', 'tpEmis', 'qrcodenfce', 'objeto_nfe'];

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

    public function getNFe($id = false)
    {
        if (!$id) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }
}
