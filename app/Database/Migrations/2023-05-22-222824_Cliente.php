<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cliente extends Migration
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
            'tipo_pessoa' => [
                'type'          => 'INT',
                'constraint'    =>  1,
                'unsigned'      => true,
                'coment'        =>  'Pessoa física ou Jurídica',
                'null'          => true,
            ],
            'cpf_cnpj' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  14,
                'null'          => true,
            ],
            'rg_ie' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  25,
                'null'          => true,
            ],
            'inscr_munic' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  15,
                'null'          => true,
            ],
            'nome_razao_social' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'apelido_nome_fantasia' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'estado_civil' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'sexo' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'nacionalidade' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'dt_chegada' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'naturalidade' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'dt_nascimento_abertura' => [
                'type'          => 'DATE',
                'null'          => true,
            ],
            'cnae_cod' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
                'null'          => true,
            ],
            'profissao' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'escolaridade' => [
                'type'          => 'INT',
                'null'          => true,
            ],
            'nome_pai' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'nome_mae' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'telefone01' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  20,
                'null'          => true,
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  100,
                'null'          => true,
            ],
            'cep' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  14,
                'null'          => true,
            ],
            'pais' => [
                'type'          => 'INT',
                'default'       => 'Brasil',
            ],
            'uf' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  2,
                'default'       => 'RS',
            ],
            'cidade' => [
                'type'          => 'INT',
                'constraint'    =>  30,
                'null'          => true,
            ],
            'cMun' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'bairro' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'logradouro' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  255,
                'null'          => true,
            ],
            'nr' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  10,
                'null'          => true,
            ],
            'complemento' => [
                'type'          => 'VARCHAR',
                'constraint'    =>  50,
                'null'          => true,
            ],
            'foto_logo' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'pessoa_cliente' => [
                'type'          => 'BOOLEAN',
                'null'          => true,
            ],
            'pessoa_fornecedor' => [
                'type'          => 'BOOLEAN',
                'null'          => true,
            ],
            'pessoa_transpotadora' => [
                'type'          => 'BOOLEAN',
                'null'          => true,
            ],
            'empresa_id' => [
                'type'          => 'INT',
                'unsigned'      => true,
                'coment'        =>  'Se refere a empresa que cadastrou o cliente',
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

        $this->forge->createTable('clientes', true);
    }

    public function down()
    {
        $this->forge->dropTable('clientes', true);

    }
}
