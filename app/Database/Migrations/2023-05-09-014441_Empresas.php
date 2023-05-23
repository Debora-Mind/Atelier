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
                'default'       => 105,
                'null'          => true,
            ],
            'codMun' => [
                'type'          => 'INT',
                'constraint'    => 5,
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
            ],
            'CST_COFINS_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
            ],
            'CST_PIS_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
            ],
            'CST_IPI_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
            ],
            'frete_padrao' => [
                'type'          => 'INT',
                'constraint'    => 20,
            ],
            'tipo_pagamento_padrao' => [
                'type'          => 'VARCHAR',
                'constraint'    => 2,
            ],
            'nat_op_padrao' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'CNAE' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20,
            ],
            'CRT_ID' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'default'       => 1,
            ],
            'ambiente' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'cUF' => [
                'type'          => 'INT',
                'constraint'    => 2,
                'default'       =>  43,
            ],
            'numero_serie_nfe' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
            ],
            'numero_serie_nfce' => [
                'type'          => 'VARCHAR',
                'constraint'    => 3,
            ],
            'ultimo_numero_nfe' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'ultimo_numero_nfce' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'ultimo_numero_cte' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'ultimo_numero_mdfe' => [
                'type'          => 'INT',
                'constraint'    => 10,
            ],
            'csc' => [
                'type'          => 'VARCHAR',
                'constraint'    => 60,
            ],
            'csc_id' => [
                'type'          => 'VARCHAR',
                'constraint'    => 10,
            ],
            'tokenIBPT' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'certificado_a3' => [
                'type'          => 'TEXT',
            ],
            'ibge' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20
            ],
            'senha_centificado' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50
            ],
            'replyName' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255
            ],
            'host' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100
            ],
            'user' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100
            ],
            'secure' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  1,
                'default'       =>  'tls',
            ],
            'port' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  4,
                'default'       =>  '587',
            ],
            'fantasy' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  60
            ],
            'replyTo' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100
            ],
            'logamarca' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'default'       =>  'logocliente/logo_padrao.png',
            ],
            'system_unit_id' => [
                'type'          => 'INT',
                'constraint'    =>  10
            ],
            'path_site' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100
            ],
            'url_dominio' => [
                'type'          => 'TEXT',
            ],
            'validade_certificado' => [
                'type'          => 'TIMESTAMP',
            ],
            'situacao_cnpj' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50
            ],
            'cfop_padrao' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'default'       =>  0,
            ],
            'ambiante_nfe' => [
                'type'          => 'INT',
                'constraint'    =>  10,
                'default'       =>  3
            ],
            'ativo' => [
                'type'          => 'BOOLEAN',
                'default'       => true,
            ],
            'tema' => [
                'type'          => "ENUM('Claro', 'Escuro')",
                'default'       => 'Claro',
            ],
            'logo' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'configuracoes' => [
                'type'          => 'JSON'
            ],
            'created_at' => [
                'type'          => 'TIMESTAMP',
            ],
            'updated_at' => [
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
