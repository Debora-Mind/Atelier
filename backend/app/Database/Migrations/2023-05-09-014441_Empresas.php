<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empresas extends Migration
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
            'razao_social' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => true,
            ],
            'nome_fantasia' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'cnpj' => [
                'type'          => 'VARCHAR',
                'constraint'    => 14,
                'null'          => true,
            ],
            'ie' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'im' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'logradouro' => [
                'type'          => 'VARCHAR',
                'constraint'    => 80,
                'null'          => true,
            ],
            'numero' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10,
                'null'          => true,
            ],
            'emitentexCpl' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'bairro' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50,
                'null'          => true,
            ],
            'fone' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'cep' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'pais' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'default'       => 'Brasil',
                'null'          => true,
            ],
            'municipio' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'codPais' => [
                'type'          => 'INT',
                'constraint'    => 5,
                'default'       => 1058,//105
                'null'          => true,
            ],
            'codMun' => [
                'type'          => 'INT',
                'constraint'    => 7,
                'null'          => true,
            ],
            'uf' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'default'       => 'RS',
            ],
            'CST_CSOSN_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 4,
                'null'          => true,
            ],
            'CST_COFINS_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
                'null'          => true,
            ],
            'CST_PIS_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
                'null'          => true,
            ],
            'CST_IPI_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
                'null'          => true,
            ],
            'frete_padrao' => [
                'type'          => 'INT',
                'constraint'    => 20,
                'null'          => true,
            ],
            'tipo_pagamento_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
                'null'          => true,
            ],
            'nat_op_padrao' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'null'          => true,
            ],
            'CNAE' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
                'null'          => true,
            ],
            'CRT_ID' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'default'       => 1,
                'null'          => true,
            ],
            'ambiente' => [
                'type'          => 'INT',
                'constraint'    => 1,
                'default'       => 2,
            ],
            'cUF' => [
                'type'          => 'INT',
                'constraint'    => 2,
                'default'       =>  43,
            ],
            'numero_serie_nfe' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
                'null'          => true,
            ],
            'numero_serie_nfce' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
                'null'          => true,
            ],
            'ultimo_numero_nfe' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'null'          => true,
            ],
            'ultimo_numero_nfce' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'null'          => true,
            ],
            'ultimo_numero_cte' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'null'          => true,
            ],
            'ultimo_numero_mdfe' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'null'          => true,
            ],
            'csc' => [
                'type'          => 'VARCHAR',
                'constraint'    => 60,
                'null'          => true,
            ],
            'csc_id' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10,
                'null'          => true,
            ],
            'tokenIBPT' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ],
            'certificado_a3' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'ibge' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
                'null'          => true,
            ],
            'senha_centificado' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'replyName' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'host' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'user' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'secure' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  3,
                'default'       =>  'tls',
                'null'          => true,
            ],
            'port' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  4,
                'default'       =>  '587',
                'null'          => true,
            ],
            'fantasy' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60,
                'null'          => true,
            ],
            'replyTo' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'logomarca' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'default'       =>  'logocliente/logo_padrao.png',
                'null'          => true,
            ],
            'system_unit_id' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'path_site' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'url_dominio' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'validade_certificado' => [
                'type'          => 'TIMESTAMP',
                'null'          => true,
            ],
            'situacao_cnpj' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'cfop_padrao' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'default'       =>  0,
                'null'          => true,
            ],
            'ambiante_nfe' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'default'       =>  3,
                'null'          => true,
            ],
            'ativo' => [
                'type'          => 'BOOLEAN',
                'default'       => true,
                'null'          => true,
            ],
            'tema' => [
                'type'          => "ENUM('Claro', 'Escuro')",
                'default'       => 'Claro',
                'null'          => true,
            ],
            'logo' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'configuracoes' => [
                'type'          => 'JSON',
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

        $this->forge->createTable('empresas', true);
    }

    public function down()
    {
        $this->forge->dropTable('empresas', true);
    }
}
