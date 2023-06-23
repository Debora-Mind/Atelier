<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NFeTemp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'status_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'default'       => 1,
                'null'          => true,
            ],
            'nSeqEvento' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'cliente_id' => [
                'type'          => 'INT',
                'constraint'    =>  9,
                'unsigned'      => true,
                'null'          => true,
            ],
            'numero_nfe' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'ide_serie' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'ide_mod' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'pedidos_id' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'core_categoria_cfop_id' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'core_cfop_id' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'nfe_recibo' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'nfe_prot' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'dhRecbto' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'nProt' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'digVal' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'cStat' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'xMotivo' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'dhRegEvento' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'xJust' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'xEvento' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'ide_Id' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'ide_versao' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  45,
                'null'          => true,
            ],
            'ide_chave_nfe' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'ide_nome_xml' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  200,
                'null'          => true,
            ],
            'ide_rota_geracao' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  30,
                'null'          => true,
            ],
            'ide_cnpj_emitente' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  15,
                'null'          => true,
            ],
            'ide_status' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  11,
                'null'          => true,
            ],
            'ide_cUF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'ide_cNF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  8,
                'null'          => true,
            ],
            'ide_natOp' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'null'          => true,
            ],
            'ide_nNF' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'ide_dhEmi' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'ide_tpNF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'ide_idDest' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'ide_cMunFG' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'ide_tpImp' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_tpEmis' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_cDV' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_tpAmb' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_finNFe' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_indFinal' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_indPres' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_procEmi' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'ide_verProc' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'emit_CNPJ' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  14,
                'null'          => true,
            ],
            'emit_xNome' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_xFant' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_enderEmit' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'emit_xLgr' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_nro' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_xCpl' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_xBairro' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_cMun' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  7,
                'null'          => true,
            ],
            'emit_xMun' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_UF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'emit_CEP' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  8,
                'null'          => true,
            ],
            'emit_cPais' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  4,
                'null'          => true,
            ],
            'emit_xPais' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_fone' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  14,
                'null'          => true,
            ],
            'emit_IE' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  14,
                'null'          => true,
            ],
            'emit_CRT' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'emit_indIEDest' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'emit_email' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'emit_CPF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  11,
                'null'          => true,
            ],
            'tot_vBC' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vICMS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vICMSDeson' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vFCP' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vBCST' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vST' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vFCPST' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vFCPSTRet' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vProd' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vFrete' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vSeg' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vDesc' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vII' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vIPI' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vIPIDevol' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vPIS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vCOFINS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vOutro' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vNF' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'tot_vTotTrib' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'fret_modFrete' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'null'          => true,
            ],
            'fat_nFat' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'fat_vOrig' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'fat_vDesc' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'fat_vLiq' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'dup_nDup' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  3,
                'null'          => true,
            ],
            'dup_dVenc'         => [
                'type'          => 'DATETIME',
                'null'          => TRUE
            ],
            'dup_vDup' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'detPag_tPag' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'null'          => true,
            ],
            'detPag_vPag' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'detPag_vTroco' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'infAd_Fisco' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2000,
                'null'          => true,
                'default'       => 'informacoes para o fisco',
            ],
            'inf_Cpl' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2000,
                'null'          => true,
                'default'       => 'informacoes complementares',
            ],
            'pedido_id' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'verAplic' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'chNFe' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'data_cancelamento'         => [
                'type'          => 'DATETIME',
                'null'          => TRUE
            ],
            'tpEvento' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'xCorrecao' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'path_xml' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'parh_file' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'hora_saida' => [
                'type'          => 'TIME',
                'null'          => true,
            ],
            'data_saida' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'finNFe' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
                'comente'       => 'se for complementar = 2',
            ],
            'data_processamento' => [
                'type'          => 'DATETIME',
                'null'          => true,
            ],
            'nRec' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'cUF' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'acronym' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'motive' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'timestamp' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'type' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
                'null'          => true,
            ],
            'tpEmis' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
                'null'          => true,
            ],
            'qrcodenfce' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type'          => 'TIMESTAMP',
                'null'          =>  true,
            ],
            'deleted_at' => [
                'type'          => 'TIMESTAMP',
                'null'          =>  true,
            ],
            ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id',
            'CASCADE');

        $this->forge->addForeignKey(
            'cliente_id',
            'clientes',
            'id');

        $this->forge->addForeignKey(
            'status_id',
            'status_nfe',
            'id');

        $this->forge->addForeignKey(
            'ide_natOp',
            'natureza_operacao_nfe',
            'id');

        $this->forge->createTable('nfe_temp', true);
    }

    public function down()
    {
        $this->forge->dropTable('nfe_temp', true);
    }
}
