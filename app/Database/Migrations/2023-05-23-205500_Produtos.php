<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produtos extends Migration
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
            'valor' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'default'       => 0,
            ],
            'cProd' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'comment'       => '* Código real do produto',
                'null'          => true,
            ],
            'cEAN' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'comment'       => '* Codigo de Barras do Item dentro do pacote',
                'null'          => true,
            ],
            'cEANTrib' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'comment'       => '* Codigo de Barras do Pacote de Itens "Grupo de Itens"',
                'null'          => true,
            ],
            'xProd' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'comment'       => '* Descrição do produto',
                'null'          => true,
            ],
            'cod_fabrica' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'comment'       => 'Codigo ou referencia de fabrica',
                'null'          => true,
            ],
            'uCom_Entrada' => [
                'type'          => 'VARCHAR',
                'constraint'    => 5,
                'comment'       => '* (unid_medida) - Unidade de medida Comercial Entrada',
                'null'          => true,
            ],
            'uCom_Saida' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'comment'       => '* (unid_medida) - Unidade de medida Comercial Saidas',
                'null'          => true,
            ],
            'uTrib' => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
                'comment'       => '* (unid_medida) - Unidade de medida Tributada',
                'null'          => true,
            ],
            'qTrib' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Quantidade Tributada',
                'null'          => true,
            ],
            'vUnTrib' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Valor Unitario Tributario',
                'null'          => true,
            ],
            'tp_produto' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'comment'       => '* (Sem Tabela) - Tipo de produto "Serviço ou Produto"',
                'null'          => true,
            ],
            'vender_sem_estoque' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'comment'       => '* (Sem Tabela) - Vender sem estoque "Sim ou Não"',
                'null'          => true,
            ],
            'prod_balanca' => [
                'type'          => 'VARCHAR',
                'constraint'    => 1,
                'comment'       => '* (Sem Tabela) - Se o produto usa balança - se vendido no peso "Sim ou Não"',
                'null'          => true,
            ],
            'tp_item' => [
                'type'          => 'INT',
                'comment'       => '* (tipo_item) - Tipo de item "Revenda, Materia Prima, Produto Final ..."',
                'null'          => true,
            ],
            'grupo' => [
                'type'          => 'INT',
                'comment'       => '* (prod_grupo) - Grupo de produtos',
                'null'          => true,
            ],
            'sub_grupo' => [
                'type'          => 'INT',
                'comment'       => '* (prod_subgrupo) - Sub_grupo fica vinculado ao grupo',
                'null'          => true,
            ],
            'departamento' => [
                'type'          => 'INT',
                'comment'       => '* (prod_depart) - Departamento',
                'null'          => true,
            ],
            'classe' => [
                'type'          => 'INT',
                'comment'       => '* (prod_classe) - Classe do produto',
                'null'          => true,
            ],
            'valor_entrada' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'comment'       => 'Valor do paroduto recebido',
            ],
            'valor_saida' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'comment'       => 'Valor do produto entregue',
            ],
            'margem_lucro_bruto' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'comment'       => 'Margem de lucro bruto',
            ],
            'vUnCom' => [
                'type'          => 'DOUBLE',
                'constraint'    => '9,2',
                'unsigned'      => true,
                'comment'       => '* Valor Unitario Comercial " Preço de venda"',
            ],
            'NCM' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'comment'       => '* Codigo NCM "Nomeclatura Comum do Mercosul"',
            ],
            'CEST' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'comment'       => 'CEST "Codigo Estadual de Substituição Tributara"',
            ],
            'CFOP_Saida' => [
                'type'          => 'VARCHAR',
                'constraint'    => 4,
                'comment'       => '* Codigo CFOP de Saida "Codigo Fiscal de Operações do Produtos"',
            ],
            'CFOP_Entrada' => [
                'type'          => 'VARCHAR',
                'constraint'    => 4,
                'comment'       => '	Codigo CFOP de Entrada "Codigo Fiscal de Operações do Produtos"',
            ],
            'tPIS_cst' => [
                'type'          => 'INT',
                'comment'       => '* Situação Tributária do PIS',
                'null'          => true,
            ],
            'tPIS_tpcalc' => [
                'type'          => 'INT',
                'comment'       => '* Tipo de Calculo "Valor ou Percentual" 1= % | 2 =R$',
                'null'          => true,
            ],
            'tPIS_aliq' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Aliquota do PIS',
                'null'          => true,
            ],
            'tCOFINS_cst' => [
                'type'          => 'VARCHAR',
                'constraint'    => 11,
                'comment'       => '* Situação Tributária do COFINS',
                'null'          => true,
                'default'       => '00',
            ],
            'tCOFINS_tpcalc' => [
                'type'          => 'INT',
                'comment'       => '* Tipo de Calculo "Valor ou Percentual" 1= % | 2 =R$',
                'null'          => true,
            ],
            'tCOFINS_aliq' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Aliquota do COFINS',
                'null'          => true,
            ],
            'tIPI_cst' => [
                'type'          => 'INT',
                'comment'       => '* Situação Tributária do IPI',
                'null'          => true,
            ],
            'tIPI_tpcalc' => [
                'type'          => 'INT',
                'comment'       => '* Tipo de Calculo "Valor ou Percentual" 1= % | 2 =R$',
                'null'          => true,
            ],
            'tIPI_aliq' => [
                'type'          => 'DOUBLE',
                'comment'       => '* Aliquota do COFINS',
                'null'          => true,
            ],
            'tICMS_cst_A' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'comment'       => '* Situação Tributária do ICMS - Parte A',
                'null'          => true,
            ],
            'tICMS_cst' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'comment'       => '* Situação Tributária do ICMS - Parte B',
                'null'          => true,
            ],
            'tICMS_tpcalc' => [
                'type'          => 'INT',
                'comment'       => '* Tipo de Calculo "Valor ou Percentual" 1= % | 2 =R$',
                'null'          => true,
                'default'       => 1,
            ],
            'tICMS_aliq' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Aliquota do ICMS',
                'null'          => true,
            ],
            'tICMS_origem' => [
                'type'          => 'INT',
                'comment'       => '* Origem do produto "Nacional, impportado ..."',
                'null'          => true,
            ],
            'tICMS_mva' => [
                'type'          => 'DOUBLE',
                'constraint'    => '10,2',
                'comment'       => '* Percentual da MVA Original, quando o produto for ST',
                'null'          => true,
            ],
            'ICMS_beneficio' => [
                'type'          => 'INT',
                'comment'       => 'Se o produto tem Beneficio Fiscal',
                'null'          => true,
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'constraint'    => 9,
                'unsigned'      => true,
            ],
            'img' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'roteiro_pdf' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'created_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
            'updated_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
            'deleted_at'         => [
                'type'           => 'DATETIME',
                'null'           => TRUE
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey(
            'empresa_id',
            'empresas',
            'id',
            'CASCADE');

        $this->forge->createTable('produtos', true);
    }

    public function down()
    {
        $this->forge->dropTable('produtos', true);
    }
}
