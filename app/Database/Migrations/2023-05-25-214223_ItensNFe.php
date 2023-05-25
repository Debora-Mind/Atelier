<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItensNFe extends Migration
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
            'nfe_temp_id' => [
                'type'          => 'INT',
            ],
            'prod_cProd' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ],
            'prod_item' => [
                'type'          => 'VARCHAR',
                'constraint'    => 14,
                'null'          => true,
            ],
            'prod_pedido_id' => [
                'type'          => 'INT',
            ],
            'prod_nNF' => [
                'type'          => 'VARCHAR',
                'constraint'    => 14,
                'null'          => true,
            ],
            'prod_indTot' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'null'          => true,
            ],
            'nfe_temp_serie' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'prod_cEAN' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'prod_xProd' => [
                'type'          => 'VARCHAR',
                'constraint'    => 120,
                'null'          => true,
            ],
            'prod_NCM' => [
                'type'          => 'VARCHAR',
                'constraint'    => 8,
                'null'          => true,
            ],
            'prod_CFOP' => [
                'type'          => 'VARCHAR',
                'constraint'    => 4,
                'null'          => true,
            ],
            'prod_uCom' => [
                'type'          => 'VARCHAR',
                'constraint'    => 6,
                'null'          => true,
            ],
            'prod_qCom' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'prod_vUnCom' => [
                'type'          => 'VARCHAR',
                'constraint'    => 21,
                'null'          => true,
            ],
            'prod_vProd' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'prod_cEANTrib' => [
                'type'          => 'VARCHAR',
                'constraint'    => 14,
                'null'          => true,
            ],
            'prod_uTrib' => [
                'type'          => 'VARCHAR',
                'constraint'    => 6,
                'null'          => true,
            ],
            'prod_qTrib' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'prod_vUnTrib' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'icms_orig' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'null'          => true,
            ],
            'icms_CST' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'null'          => true,
            ],
            'icms_modBC' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'null'          => true,
            ],
            'icms_vBC' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'icms_pICMS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'icms_vICMS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'pis_CST' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'null'          => true,
            ],
            'pis_vBC' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'pis_pPIS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'pis_vPIS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'cofins_CST' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'null'          => true,
            ],
            'cofins_vBC' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'cofins_pCOFINS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'cofins_vCOFINS' => [
                'type'          => 'DOUBLE',
                'constraint'    => '15,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'produto_id' => [
                'type'          => 'INT',
            ],
            'empresa_id' => [
                'type'          => 'INT',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id',
            'CASCADE');

        $this->forge->addForeignKey(
            'produto_id',
            'produtos',
            'id',
            'CASCADE');

        $this->forge->addForeignKey(
            'nfe_temp_id',
            'nfe_temp',
            'id',
            'CASCADE');

        $this->forge->createTable('itens_nfe', true);
    }

    public function down()
    {
        $this->forge->dropTable('itens_nfe', true);
    }
}
